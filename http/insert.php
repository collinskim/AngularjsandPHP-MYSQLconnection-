<?php 
	$conn = mysqli_connect("localhost", "root", "", "conn_db");
	$info = json_decode(file_get_contents("php://input"));
	if (count($info) > 0) {
		$name = mysqli_real_escape_string($conn, $info->name);
		$email = mysqli_real_escape_string($conn, $info->email);
		$age = mysqli_real_escape_string($conn, $info->age);
		$btn_name = $info->btnname;
		if ($btn_name == "insert") {
			$query = "INSERT INTO conn_tbl (name, email, age) VALUES ('$name', '$email', '$age')";
				if (mysqli_query($conn, $query)) {
					echo "data inserted successfully....";
				}
				else{
					echo "failed";
				}
		}
		if ($btn_name == "update") {
			$id = $info->id;
			$query = "UPDATE conn_tbl SET name = '$name', email = '$email', age = '$age' WHERE id = '$id'";
			if (mysqli_query($conn, $query)) {
				echo 'Data Updated successfully....';
			}
			else {
				echo "Failed";
			}
		}
	}
?>