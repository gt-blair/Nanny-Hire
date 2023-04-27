<?php

require_once 'session.php';
require_once 'DB.php';
require_once 'helpers.php';

if (isset($_POST['login'])) {
    $input = clean($_POST);

    $contact = $input['contact'];
    $password = $input['password'];

    if ($contact == "7070808080" && $password == "admin123") {
        $s = new stdClass();
        $s->name = "admin";
        $_SESSION['user'] = $s;

        header('Location: ../admin.php');
        exit();
    } else {
        $stmt = DB::query(
            "SELECT * FROM nannys WHERE contact=? AND password=?",
            [$contact , $password]
        );
        $nanny = $stmt->fetch(PDO::FETCH_OBJ);

        if (isset($nanny->name)) {
            $_SESSION['user'] = $nanny;
            header('Location: ../provider.php');
            exit();
        } else {
            header('Location: ../login.php?msg=failed');
            exit();
        }
    }
}
