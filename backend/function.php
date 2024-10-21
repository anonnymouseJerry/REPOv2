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

function OfficeNameChart($id){
    global $conn;
    $query = 'SELECT officeName FROM offices WHERE office_id=?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($officeName);
    $stmt->fetch();
    $stmt->close();
    return $officeName;
}

function UploaderName($id) {
    global $conn;
    $query = 'SELECT full_name FROM users WHERE id = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($fullName); // Correct variable name here
    $stmt->fetch();
    $stmt->close();
    return $fullName;
}
?>