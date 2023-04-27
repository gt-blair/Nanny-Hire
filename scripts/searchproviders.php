<?php

require_once 'helpers.php';
require_once 'DB.php';

if (isset($_POST['location']) && isset($_POST['work_hours'])) {
    $input = clean($_POST);
    
    $location = $input['location'];
    $work_hours = $input['work_hours'];

    $sql = "SELECT * FROM `nannys` WHERE location=? AND work_hours=?";
    $stmt = DB::query($sql, [
        $location, $work_hours
    ]);

    $nannys = $stmt->fetchAll(PDO::FETCH_OBJ);

    if (count($nannys) > 0) {
        echo json_encode($nannys);
    } else {
        echo '{"failed": true }';
    }
}
