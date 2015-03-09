
<?php
mysql_pconnect("68.178.143.100", "sfitver3", "w3bS1Tedb@SF") or die('unable to connect');
echo "Connection stablished<br/>";

mysql_select_db('sfitver3') or die ('unable to select database');

echo "Connection connected to database";

$result = mysql_query("select * from users") or die("unable to query");


while ($row = mysql_fetch_assoc($result)) {
    echo $row["id"];
    echo $row["user_name"];
}
?>
