<?php

include_once "./include/header.php";
include_once "./scripts/DB.php";
$locations = ["Pressy", 'Scoops', "Tap & Out", "Boston","Police Line","Chemundu","Postal Area","Catholic", "Patrina"];

if (!isset($_GET['nanny'])) {
    header('Location: index.php');
    exit();
}

$nanny = DB::query("SELECT * FROM nannys WHERE id=?", [$_GET['nanny']])->fetch(PDO::FETCH_OBJ);

if ($nanny === false) {
    header('Location: index.php');
    exit();
}

include_once "msg/booking.php";

?>

<div class="container" style="margin-top: 30px;">
    <div class="card text-center">
        <div class="card-header">
            <h3>Details about <?= $nanny->name; ?></h3>
        </div>
        <div class="container" style="margin-top: 30px;">
            <div class="row">
                <div class="col">
                    <img style="height: 250px"
                        src="images/<?= $nanny->photo; ?>">
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Name</th>
                    <td>
                        <?= $nanny->name; ?>
                    </td>
                    <th>Work Hours</th>
                    <td>
                        <?= $nanny->work_hours;?>
                    </td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>
                        <?= $nanny->contact2; ?>,
                        <?= $nanny->adder2; ?>
                    </td>
                    <th>Location</th>
                    <td>
                        <?= $nanny->location; ?>
                    </td>
                </tr>
            </table>
        </div>

    </div>
</div>


<div class="container" style="margin-bottom: 60px;margin-top: 20px;">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h3 class="text-center">Book Nanny Service from <?= $nanny->name; ?>
                </h3>
            </div>
            <hr>

            <form action="scripts/bookhall.php" method="post">
                <input type="hidden" name="nanny"
                    value="<?= $nanny->id; ?>">
                <div class="form-group">
                    <label for="">First Name</label>
                    <input id="fname" name="fname" type="text" class="form-control" placeholder="First Name" required>
                </div>

                <div class="form-group">
                    <label for="">Last Name</label>
                    <input id="lname" name="lname" type="text" class="form-control" placeholder="Last Name" required>
                </div>

                <div class="form-group">
                    <label for="">Contact No.</label>
                    <input id="contact" name="contact" type="text" class="form-control" placeholder="Contact No."
                        minlength="10" maxlength="10"
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                </div>

                <div class="form-group">
                    <label for="">Location</label>
                    <select class="form-control" name="contact2" id="contact2">
                        <option value="none">-- Select Location --</option>
                        <?php foreach ($locations as $location) : ?>
                        <option value="<?= $location ?>"> <?= $location ?>
                        </option>
                        <?php endforeach; ?>
                </select>
                </div>

                <div class="form-group">
                    <label for="">Date</label>
                    <input class="form-control" type="date" name="date" id="date" required>
                </div>

                <div class="form-group">
                    <label for="">Payment Mode</label>
                    <select class="form-control" name="payment" id="payment" required>
                        <option value="Cash">Cash</option>
                        <option value="M-Pesa">M-Pesa</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Problem</label>
                    <textarea id="queries" name="queries" class="form-control" maxlength="255"
                        placeholder="Any queries..?"></textarea>
                </div>

                <button style="margin-top: 30px" class="btn btn-block btn-primary" type="submit" name="book"
                    id="book">Book Service</button>
            </form>

        </div>
    </div>
</div>

<?php include_once "include/footer.php";
