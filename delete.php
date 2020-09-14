<?php
include('connection.php');
$id = null;
$data = json_decode(file_get_contents("php://input"));
@$id=$mysqli->real_escape_string($data->id);

    $query = "DELETE FROM contatos WHERE id='$id'";
    $mysqli->query($query);

    $mysqli->close();
    print json_encode($data);
?>