
<?php
$mysqli = new mysqli("71.6.135.69", "u_dw_shinebright", "harhar321", "dw_shinebright");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$query = "SELECT * from vcfo_users";

if ($result = $mysqli->query($query)) {

    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
       echo "sds<br/>";
    }

    /* free result set */
    $result->free();
}

/* close connection */
$mysqli->close();
?>