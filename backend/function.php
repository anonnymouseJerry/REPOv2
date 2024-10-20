<?php

function OfficeName($id){
    global $conn;
    $query = 'SELECT officeCode FROM offices WHERE office_id=?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($officeName);
    $stmt->fetch();
    $stmt->close();
    return $officeName;
}

?>