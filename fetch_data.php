<?php

include('connection.php');

$query = "SELECT * FROM tbl_sample ORDER BY id";
$statament	= $connect->prepare($query);
if($statament->execute())
{		
	while($row = $statament->fetch(PDO::FETCH_ASSOC))
	{
			$data[] = $row;
	}

	echo json_encode($data);
}

?>