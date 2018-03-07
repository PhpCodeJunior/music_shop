<div class="row" id="footer_ground"><br>
    <div class="col-sm-4">
        <h2>ZASTO MI?</h2>
        <ul class="list-group"  style="list-style-type: none;">
            <li><a href="" class="list-group-item-disabled">IMAMO SVE STO VAM TREBA</a></li>
            <li><a href="" class="list-group-item-disabled">ZASTO SMO NAJBOLJI</a></li>
            <li><a href="" class="list-group-item-disabled">NAJBRZA ISPORUKA</a></li>
        </ul>

    </div>
    <div class="col-sm-4">
        <h2>KAKO KUPITI?</h2>
        <ul class="list-group" style="list-style-type: none;">
            <li><a href="" class="list-group-item-disabled">POUZECEM</a></li>
            <li><a href="" class="list-group-item-disabled">CEKOVIMA GRADJANA</a></li>
            <li><a href="" class="list-group-item-disabled">KREDITNIM KARTICAMA</a></li>
        </ul>
    </div>
    <div class="col-sm-4">
        <h2>PITAJTE NAS</h2>
        <form method="post" action="" class="form-group">
            <input type="text" name="name" class="form-control" placeholder="vase ime">
            <input type="text" name="email" class="form-control" placeholder="vas email">
            <textarea name="text" type="text" class="form-control" placeholder="vasa poruka"></textarea>
            <input type="submit" name="submit" class="form-control" value="POSALJI">
        </form>
        <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
           @$name = $_POST["name"];
            @$email = $_POST["email"];
            @$txt = $_POST["text"];
            if(empty($name) || empty($email) || empty($txt)){
                echo "<div class='alert alert-danger'>POPUNITE SVA POLJA</div>";
            }else {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "<div class='alert alert-danger'>EMAIL NIJE VALIDAN</div>";
                } else {
                    $to = "slavkoslave89@gmail.com";
                    $from = $email;
                    $text = $txt;
                    mail($to, $from, $text);
                    echo "<div class='alert alert-danger'>USPESNO STE POSLALI PORUKU</div>";
                }
            }
        }else{
            //echo "<div class='alert alert-danger'>MAIL NIJE POSLAT</div>";

        }

        ?>

    </div>
</div>
<div class="col-sm-12" id="footer_bottom">
    <p>&copy;2018/MusicShop</p>
</div>
</div>
</div>
</body>
</html>