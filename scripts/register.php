<?php

require_once 'session.php';
require_once 'DB.php';
require_once 'helpers.php'; 

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

    $isProviderCreated = DB::query("INSERT INTO nannys values(DEFAULT, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [
            $name,$contact,$descr,$contact2,$adder2,$location,$password,$file1, $work_hours
        ]);

    if ($isProviderCreated) {
        header('Location: ../register.php?msg=success');
        exit();
    } else {
        unlink('../storage/'.$file1);
        header('Location: ../register.php?msg=failed');
        exit();
    }
}
?>