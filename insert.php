<?php
include('connection.php');

$celular = '';
$id= '';
$name = '';
$data=json_decode(file_get_contents("php://input"));


@$id=$mysqli->real_escape_string($data->id);
@$name=$mysqli->real_escape_string($data->name);
@$celular=$mysqli->real_escape_string($data->celular);
	



$sql = "INSERT INTO contatos VALUES('$name', '$celular')";

$mysqli->query($sql);

$mysqli->close();
print json_encode($data);
?>
