<?php
	$conn = mysqli_connect("localhost", "root", "", "conn_db");
	$data = json_decode(file_get_contents("php://input"));
	if (count($data)> 0) {
		$id = $data->id;
		$query = "DELETE FROM conn_tbl WHERE id = '$id'";
		if (mysqli_query($conn, $query)) {
			echo "Data Deleted Successfully....";
		}
		else {
			echo "Failed";
		}
	}
?>