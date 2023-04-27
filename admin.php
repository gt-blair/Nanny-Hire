<?php
    include_once "scripts/checklogin.php";
    include_once "scripts/DB.php";
    include_once "include/header.php";

    if (!check("admin")) {
        header('Location: logout.php');
        exit();
    }

    $sql = "SELECT b.*, p.name AS nanny_name FROM bookings AS b, nannys AS p WHERE b.nanny_id = p.id ORDER BY b.date DESC";

    $bookings = DB::query($sql)->fetchAll(PDO::FETCH_OBJ);


    include_once "msg/admin.php";
?>
<div class="container" style="margin-top: 30px; margin-bottom: 60px;">
    <h2 class="text-center"> Bookings </h2>
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>Name</th>
                <th>Contact</th>
                <th>Contact 2</th>
                <th>Date</th>
                <th>Payment Method</th>
                <th>Queries</th>
                <th>Nanny Name</th>
                <th>Action</th>
            </tr>
            <?php foreach ($bookings as $booking): ?>
            <tr>
                <td>
                    <?= $booking->fname; ?> <?= $booking->lname; ?>
                </td>
                <td>
                    <?= $booking->contact; ?>
                </td>
                <td>
                    <?= $booking->contact2; ?>
                </td>
                <td>
                    <?= $booking->date; ?>
                </td>
                <td>
                    <?= $booking->payment; ?>
                </td>
                <td>
                    <?= $booking->queries; ?>
                </td>
                <td>
                    <?= $booking->nanny_name; ?>
                </td>
                <td>
                    <a class="btn btn-danger"
                        href="deletebooking.php?id=<?= $booking->id; ?>">Remove</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<?php include_once "include/footer.php";
