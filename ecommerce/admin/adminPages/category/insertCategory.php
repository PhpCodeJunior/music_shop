<?php

include_once(dirname(__FILE__) . "/../../../spl/spl.php");
include_once(dirname(__FILE__) . "/../../adminView.php");
$insert = new categoryController();
$select = $insert->showCat();

$bootstrap = new bootstrapAdmin();
$bootstrap->head();
$bootstrap->nav1(); ?>
<div class="row">
    <div class="col-sm-8">
        <h1>DODAJTE NOVU KATEGORIJU</h1>
        <?php $insert->addCat();
        ?>
        <form class="form-group" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="text" name="cat_name" id="kategorija" placeholder="KATEGORIJA" class="form-control">
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
            $insert->deleteCatId();
            foreach($select as $show){ ?>
            <tr>
                <td><?php echo $show->cat_name; ?></td>
                <td><a href="../category/insertCategory.php?id=<?php echo $show->cat_id; ?>">IZBRISI</a> /
                    <a href="../category/editCategory.php?ed_id=<?php echo $show->cat_id; ?>">IZMENI</a></td>
            </tr>
            <?php } ?>
        </table>
    </div>

    <?php $bootstrap->main1(); ?>

</div>

