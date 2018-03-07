<?php

include_once(dirname(__FILE__) . "/../spl/spl.php");

$bootstrap = new bootstrapClass();
$bootstrap->head();
$bootstrap->nav1();
?>
</div>
<div class="container">
    <br />
    <h2 class="advanced_find_h">PRETRAGA</h2><br />
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
            <input type="text" name="search_text" id="search_text" placeholder="VASI OMILJENI BENDOVI" class="form-control" />
        </div>
    </div>
    <br />
    <div id="result"></div>
</div>

<script>
    $(document).ready(function(){
        $('#search_text').keyup(function(){
            var search = $(this).val();
            if(search != '') {
                $.ajax({
                    url:"advanced_find_script.php",
                    method:"post",
                    data:{search_text:search},
                    dataType:"text",
                    success:function(data){
                        $("#result").html(data);
                    }
                });

            }else {
                $("#result").html("");
                $.ajax({
                    url:"advanced_find_script.php",
                    method:"post",
                    data:{search_text:search},
                    dataType:"text",
                    success:function(data){
                        $("#result").html(data);
                    }
                });
            }
        });
    });
</script>