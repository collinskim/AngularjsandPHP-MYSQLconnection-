<?php
$conn   = mysqli_connect("localhost", "root", "", "conn_db");
$output = array();
$query  = "SELECT * FROM conn_tbl";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $output[] = $row;
    }
    echo json_encode($output);
}
?>