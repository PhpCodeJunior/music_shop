<?php

include_once(dirname(__FILE__) . "/../../../spl/spl.php");
include_once(dirname(__FILE__) . "/../../adminView.php");
$insert = new brandController();
$select = $insert->showBrand();

$bootstrap = new bootstrapAdmin();
$bootstrap->head();
$bootstrap->nav1(); ?>
<div class="row">
    <div class="col-sm-8">
        <h1>DODAJTE NOV BREND</h1>
        <?php $insert->addBrand();
        ?>
        <form class="form-group" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="text" name="brand_name" id="kategorija" placeholder="BREND" class="form-control">
            <input type="submit" name="submit" id="sub" value="DODAJ" class="form-control">
        </form>
        <script>

        </script>
        <table class="table table-bordered">
            <tr>
                <th>IME</th>
                <th>AKCIJA</th>
            </tr>
            <?php
            $insert->deleteBrandId();
            foreach($select as $show){ ?>
                <tr>
                    <td><?php echo $show->brand_name; ?></td>
                    <td><a href="../brand/insertBrand.php?id=<?php echo $show->brand_id; ?>">IZBRISI</a> /
                        <a href="../brand/editBrand.php?ed_id=<?php echo $show->brand_id; ?>">IZMENI</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <?php $bootstrap->main1(); ?>

</div>
