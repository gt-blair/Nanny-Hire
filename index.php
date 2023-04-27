<?php

include_once "./include/header.php";
$locations = ["Pressy", 'Scoops', "Tap & Out", "Boston","Police Line","Chemundu","Postal Area","Catholic", "Patrina"];

?>

<h2 class="text-center" style="margin-top: 20px">Nanny Hire</h2>
<hr>
<div class="container" style="margin-top:20px; margin-bottom: 60px;">


    <div class="row">
        <div class="form-group col-5">
            <label for="">Location</label>
            <select class="form-control" name="location" id="location">
                <option value="none">-- Select Location --</option>
                <?php foreach ($locations as $location) : ?>
                <option value="<?= $location ?>"> <?= $location ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group col-5">
            <label for="">Who's Required</label>
            <select class="form-control" name="work_hours" id="work_hours">
                <option value="none">Select Work Hours</option>
                <option value="morning_halfday">Half Day(Morning)</option>
                <option value="evening_halfday">Half Day(Evening)</option>
                <option value="fullday">Full Day</option>
            </select>
        </div>

        <div class="form-group col-2">
            <label for="">Action</label>
            <button id="search" class="form-control btn btn-success" type="button">Search</button>
        </div>
    </div>

    <div class="table-responsive">
        <table id="nannys" class="table">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Work Hours</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan='5'>Select Location and Work Hours..</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="js/jquery.js"></script>
<script>
    $(function() {
        $("#search").click(function() {
            var location = $("#location").val();
            var work_hours = $("#work_hours").val();

            if (location == "none" || work_hours == "none") {
                alert("Don't leave fields empty!");
                tbody = "<tr><td colspan='5'>please </td></tr>";
            } else {
                $.post('scripts/searchproviders.php', {
                    location: location,
                    work_hours: work_hours
                }, function(res) {
                    var nannys = JSON.parse(res);
                    var tbody = "";

                    if (nannys.failed == true) {
                        tbody = "<tr><td colspan='5'>No Service nannys found...</td></tr>";
                    } else {
                        nannys.forEach(function(nanny, i) {
                            tbody += "<tr>" +
                                "<td><img style='height:150px' src='images/" + nanny
                                .photo +
                                "'/></td>" +
                                "<td>" + nanny.name + "</td>" +
                                "<td>" + nanny.contact2 + ",<br>" + nanny.adder2 +
                                ",<br>" +
                                nanny.location + "</td>" +
                                "<td>" + nanny.work_hours + "</td>" +
                                "<td><a href='booking.php?nanny=" + nanny.id +
                                "' class='btn btn-primary btn-block'>Book</a></td>";
                        });
                    }
                    $("#nannys tbody").html(tbody);
                });
            }
        });
    });
</script>

<?php include_once "./include/footer.php";
