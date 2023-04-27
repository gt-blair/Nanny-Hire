<?php include_once "./include/header.php"; ?>
<?php include_once "msg/register.php"; ?>

<?php
$locations = ["Pressy", 'Scoops', "Tap & Out", "Boston","Police Line","Chemundu","Postal Area","Catholic", "Patrina"];
?>
<div class="container" style="margin-top: 30px; max-width: 800px;margin-bottom: 60px;">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h3 class="text-center">Register as Nanny</h3>
            </div>
            <hr>


            <form action="scripts/register.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Name</label>
                    <input id="name" name="name" type="text" class="form-control" placeholder="Name" required>
                </div>

                <div class="form-group">
                    <label for="">Contact No.</label>
                    <input id="contact"
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                        name="contact" type="text" class="form-control" placeholder="Contact" minlength="10"
                        maxlength="10" required>
                </div>

                <div class="form-group">
                    <label for="">Contact No. 2</label>
                    <input id="contact2" name="contact2" type="text" class="form-control" placeholder="Contact No 2."
                        required>
                </div>

                <div class="form-group">
                    <label for="">Address Line 2</label>
                    <input id="adder2" name="adder2" type="text" class="form-control" placeholder="Enter Address line-2"
                        required>
                </div>

                <div class="form-group">
                    <label for="">Location</label>
                    <select class="form-control" name="location" id="location">
                        <?php foreach ($locations as $location) : ?>
                        <option value="<?= $location ?>"> <?= $location ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Photo(Square Size)</label>
                    <input id="photo" name="photo" type="file" class="form-control-file" placeholder="Select Photo 1"
                        required>
                </div>

                <div class="form-group">
                    <label for="">Add Description</label>
                    <textarea name="descr" id="descr" class="form-control" cols="30" rows="5"
                        placeholder="Tell something about you..." required></textarea>
                </div>

                <div class="form-group">
                    <label for="">Password</label>
                    <input id="password" name="password" type="password" class="form-control"
                        placeholder="Enter 6 Character Password" minlength="4" required>
                </div>

                <div class="form-group">
                    <label for="">Work Hours</label>
                    <select class="form-control" name="work_hours" id="work_hours">
                        <option value="morning_halfday">Half Day(Morning)</option>
                        <option value="evening_halfday">Half Day(Evening)</option>
                        <option value="fullday">Full Day</option>
                    </select>
                </div>

                <button style="margin-top: 30px;" class="btn btn-block btn-primary" type="submit" name="register"
                    id="register">Register</button>
            </form>

        </div>
    </div>
</div>

<?php include_once "./include/footer.php";?>
