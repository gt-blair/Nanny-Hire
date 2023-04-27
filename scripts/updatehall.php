<?php
include_once "session.php";
include_once "checklogin.php";
include_once "DB.php";
include_once "helpers.php";

if (!check()) {
    header('Location: logout.php');
    exit();
}

if (isset($_POST['register'])) {
    $input = clean($_POST);

    $name = $input['name'];
    $contact = $input['contact'];
    $descr = $input['descr'];
    $contact2 = $input['contact2'];
    $adder2 = $input['adder2'];
    $location = $input['location'];
    $password = $input['password'];
    $work_hours = $input['work_hours'];

    $photo = $_FILES['photo'];

    $file1 = upload($photo);

    if ($file1 === false) {
        header('Location', '../register.php?msg=file');
        exit();
    }

    $isProviderCreated = DB::query(
        "UPDATE nannys SET name=?, contact=?, contact2=?, adder2=?, location=?, photo=?, descr=?, password=?, work_hours=? WHERE id=?",
        [$name,$contact,$contact2,$adder2,$location,$file1, $descr, $password, $work_hours,$_SESSION['user']->id]
    );

    if ($isProviderCreated) {
        unlink($_SESSION['user']->photo);
        header('Location: ../logout.php');
        exit();
    } else {
        unlink('../storage/'.$file1);
        echo "";
        header('Location: ../logout.php');
        exit();
    }
}
