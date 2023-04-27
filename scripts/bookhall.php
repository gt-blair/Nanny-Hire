<?php

require_once 'helpers.php';
require_once 'DB.php';

if (isset($_POST['book'])) {
    $input = clean($_POST);
 
    $nanny = $_POST['nanny'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $contact = $_POST['contact'];
    $contact2 = $_POST['contact2'];
    $date = $_POST['date'];
    $queries = $_POST['queries'];
    $payment = $_POST['payment'];

    $sql = "INSERT INTO bookings values(DEFAULT, ?, ?, ?, ?, ?, ?, ?, ?)";
    $isBooked = DB::query($sql, [
        $nanny, $fname, $lname, $contact, $contact2, $date, $payment, $queries
    ]);

    if ($isBooked) {
        header("Location: ../booking.php?nanny=$nanny&msg=success");
        exit();
    } else {
        header("Location: ../booking.php?nanny=$nanny&msg=failed");
        exit();
    }
}
