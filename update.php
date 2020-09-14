<?php
include('connection.php');

$celular = '';
$id= '';
$name = '';
$data=json_decode(file_get_contents("php://input"));

@$dados=$mysqli->real_escape_string($data->dados);
var_dump($dados);


@$id=$mysqli->real_escape_string($data->id);
@$name=$mysqli->real_escape_string($data->name);
@$celular=$mysqli->real_escape_string($data->celular);




$sql = "UPDATE contatos SET name = '$name', celular = '$celular' WHERE id = '$id'";

$mysqli->query($sql);

$mysqli->close();
print json_encode($data);
?>

