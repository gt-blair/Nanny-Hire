<?php
    include_once "scripts/checklogin.php";
    include_once "include/header.php";
    include_once "scripts/DB.php";

    if (!check("admin")) {
        header('Location: logout.php');
        exit();
    }

    $stmt = DB::query("SELECT * FROM nannys");

    $nannys = $stmt->fetchAll(PDO::FETCH_OBJ);

    include_once "msg/managehall.php";
?>
<div class="container" style="margin-top: 30px; margin-bottom: 60px;">
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>Photo</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Address</th>
                <th>Work Hours</th>
                <th>Action</th>
            </tr>
            <?php foreach ($nannys as $nanny): ?>
            <tr>
                <td>
                    <img style="height: 150px"
                        src="images/<?= $nanny->photo; ?>"
                        alt="photo">
                </td>
                <td><?= $nanny->name; ?>
                </td>
                <td><?= $nanny->contact; ?>
                </td>
                <td>
                    <?= $nanny->contact2; ?>,<br>
                    <?= $nanny->adder2 ?>,<br>
                    <?= $nanny->location; ?>
                </td>
                <td><?= $nanny->work_hours; ?>
                </td>
                <td>
                    <form action="deletehall.php" method="post">
                        <input type="hidden" name="id"
                            value="<?= $nanny->id ;?>">
                        <button type="submit" name="remove" class="btn btn-danger btn-block">Remove</a>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<?php include_once "include/footer.php";
