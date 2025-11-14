<?php
ini_set('display_errors',1); error_reporting(E_ALL);
include 'db_connect.php';

$r = $conn->query("SELECT DATABASE() db"); 
echo "DB: ".($r?$r->fetch_assoc()['db']:'?')."<br>";

echo "<pre>Tables:\n";
$t = $conn->query("SHOW TABLES");
while($row = $t->fetch_array()) echo " - ".$row[0]."\n";
echo "</pre>";

$counts = [
  'users'  => $conn->query("SELECT COUNT(*) c FROM users"),
];
foreach ($counts as $name => $res) {
  echo $name.": ";
  echo ($res ? $res->fetch_assoc()['c'] : "no table")."<br>";
}
