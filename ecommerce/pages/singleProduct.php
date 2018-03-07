<?php
  include_once(dirname(__FILE__) . "/../spl/spl.php");

$bootstrap = new bootstrapClass();
$help = new helpers();

$bootstrap->head();
$bootstrap->nav1(); ?>
</div>
    <div class="row">
        <div class="col-sm-8">
            <div class="well">
                    <?php
                    $comments = new commController();
                    $comments->createComm();
                    @$users = $help->getLoggedInUserId($_SESSION["name"]);
                    $pro = new ProductController();
                    $cart = new CartController();
                    $cart->addCart();
                    if(isset($_GET["id"])){
                    $product = $pro->showSingleProduct($_GET["id"]);
                    foreach($product as $p){
                    ?>
                    <img src="../images/product/<?php echo $p->pro_img; ?>" class="img-thumbnail">
                    <div class="col-sm-6">
                        <p class="center-left">IME PROIZVODA: <?php echo $p->pro_name; ?></p>
                        <p class="center-left">CENA PROZIVODA: <?php echo $p->pro_price; ?> DINARA</p>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form-group">
                            <input type="hidden" name="user_id" class="form-control">
                            <input type="hidden" name="pro_id" value="<?php echo $p->pro_id; ?>" class="form-control">
                            <input type="number" name="q" min="0" max="100" step="1" value="1" class="form-control">
                            <input type="submit" name="submit" class="btn btn-primary" value="DODAJ U KORPU">
                        </form>
                    </div>
                     <div class="row">
                        <div class="panel panel-primary">
                            <div class="panel-heading">SPECIFIKACIJA O PROIZVODU</div>
                            <div class="panel-body">
                                <?php echo $p->pro_body;
                                ?>
                            </div>
                        </div>
                     </div>

                        <?php }} ?>
                <h4>Ostavite komentar:</h4>
                <?php

                ?>
                <form method="post" name="form_comm" onclick="return validate()" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="form-group">
                        <input type="hidden" name="user_id">
                        <input type="hidden" name="pro_id" value="<?php echo @$p->pro_id; ?>">
                        <input type="hidden" name="realdate">
                        <textarea name="txt" class="form-control" type="text"   rows="3"></textarea>
                        <p id="error"></p>
                    </div>
                    <input type="submit" class="btn btn-success"  name="submit" value="POSALJI">
                </form>
                <script>
                        function validate(){
                        var comments = document.forms["form_comm"]["txt"].value;
                        if(comments==""){
                        document.getElementById("error").innerHTML="POLJE MORATE POPUNITI";
                        }
                        }
                 </script>
                <br><br>

                <p><span class="badge"><?php $comments->countComm(@$p->pro_id); ?></span> Komentari:</p><br>
                <div class="row">
                    <?php
                    $comments->deleteCommId();
                    $join = $comments->join(@$p->pro_id);
                    foreach($join as $comm){?>
                <div class="col-sm-2 text-center">
                        <img src="../images/users/<?php echo $comm->user_img; ?>" class="img-circle" height="65" width="65" alt="Avatar">
                    </div>
                         <div class="col-sm-10">
                          <h4><?php echo $comm->user_name;  ?> <small><?php echo $comm->realdate; ?></small></h4>
                             <p><?php echo $comm->txt; ?></p>
                             <?php
                                 if($comm->user_name == @$_SESSION["name"]){  ?>
                             <a href="singleProduct.php?delCommId=<?php echo $comm->comm_id; ?>">IZBRISI</a> | <a href="">IZMENI</a>
                             <?php }else{
                                 echo "<p>ULOGUJTE SE DA BI STE UPRAVLJALI SVOJIM KOMENTARIMA</p>";
                             }?>
                              <button onclick="replayComm(<?php echo $comm->comm_id; ?>)">REPLAY</button>
                          <br>
                        </div>
                    <?php } ?>
                       <script>
                            $(document).ready(function(){
                                $("button").click(function(){
                                    $("#forma").toggle();
                                });
                            });
                        </script>
                       <?php if(isset($_POST["replay"])) {
                       if(isset($_POST["parentComm"])){
                            $username = $comments->getLoggedInUserId($_SESSION["name"]);
                            if(empty($comments->setTxt())){
                                 echo '<script>function valid(){
                                        var comm = document.forms["f"]["txt"].value;
                                        if(comm==""){
                                        document.getElementById("p").innerHTML="POLJE MORATE POPUNITI";
                                        }}</script>';
                            }else{
                            if($comments->insertReplayComm($username,@$comm->pro_id, $comments->setTxt(), $comments->setDate(),$comments->setReplayId())){
                                 }
                            }
                            }
                        }
                        ?>
                         <script>
                        function replayComm(id){
                        var input = document.getElementById("parentComm");
                        input.value=id;
                        }
                         $(document).ready(function(){
                            $("#replay").click(function(}{
                           var search = $("#text_comm").val();
                                $.ajax({
                                    url:"nav.php",
                                    method:"POST",
                                    data:{search:search},
                                    success:function(data)
                                    {
                                        body.onload("singleProduct.php?id=<?php  if(isset($_POST['pro_id'])){ echo $_POST['pro_id']; } ?>");
                                    },
                                });
                            });
                           });
                        </script>
                        <form method="post" action="" id="forma" name="f" onclick="return valid()" class="form-group" style="width:300px;display: none;">
                        <input type="hidden" name="user_id">
                        <input type="hidden" name="comm_id">
                        <input type="hidden" name="pro_id" value="<?php  echo @$comm->pro_id; ?>">
                        <input type="hidden" name="realdate">
                        <input type="hidden" name="parent_id" id="text_comm" value="<?php echo @$comm->comm_id; ?>">
                        <input type="hidden" name="parentComm" id="parentComm" value="0">
                        <textarea name="txt" type="text" id="text" cols="30" class="form-control"></textarea>
                        <p id="p"></p>
                        <input type="submit" name="replay" id="replay"   class="form-control" value="Posalji">
                        </form>

                    <br>
                    <div class="col-xs-10" style="right:-310px;">
                    <?php
                    $parent = $comments->joinParent(@$comm->comm_id);
                     foreach($parent as $replay){
                     ?>
                     <img src="../images/users/<?php echo $replay->user_img; ?>" class="img-circle" height="65" width="65" alt="Avatar">
                      <h4><?php echo $replay->user_name; ?> <small><?php echo $replay->realdate; ?></small></h4>
                      <p><?php echo $replay->txt; ?></p>
                      <?php } ?>
                      <br>
                    </div>
                </div>


            </div>
        </div>
        <?php $bootstrap->cb(); ?>
    </div>
<?php
$bootstrap->footer();
?>