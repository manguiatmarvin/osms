
<?php
mysql_pconnect("68.178.143.18", "sfitcrm", "mgmtSyst3Mdb@SF123") or die('unable to connect');
mysql_select_db('sfitcrm') or die ('unable to select database');
$result = mysql_query("select * from users") or die("unable to query");


while ($row = mysql_fetch_assoc($result)) {
    echo $row["id"];
    echo $row["user_name"];
}
?>
