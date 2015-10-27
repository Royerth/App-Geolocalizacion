<?php 
header('Content-Type: text/xml'); 
echo '<markers>';
include_once 'dbMySql.php';
$con = new DB_con();
$sql=mysqli_query($con,"select * from users");
while($row=mysqli_fetch_array($sql))
{
	echo "<marker id ='".$row['users_id']."' lat='".$row['coordenada_x']."' lng='".$row['coordenada_y']."'>\n";
	echo "</marker>\n";
}
mysql_close($bd);
echo "</markers>\n";
?>