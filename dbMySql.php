c<?php
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME', 'dbtuts');

class DB_con
{
	function __construct()
	{
		$conn = mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die('localhost connection problem'.mysql_error());
		mysql_select_db(DB_NAME, $conn);
	}
	
	public function insert($fname,$lname,$email,$lugar,$coordenada_x,$coordenada_y,$imagen)
	{
		$res = mysql_query("INSERT users(nombre,apellido,email,lugar,coordenada_x,coordenada_y,imagen) VALUES('$fname','$lname','$email','$lugar','$coordenada_x','$coordenada_y','$imagen')");
		return $res;
	}
	
	public function select()
	{
		$res=mysql_query("SELECT * FROM users");
		return $res;
	}

	public function delete($id){
		$res=mysql_query("DELETE FROM users WHERE user_id=$id");
		return $res;
	}

	public function update($user_id,$fname,$lname,$email1,$lugar1,$coordenada1,$coordenada2,$imagen){
		$res=mysql_query("UPDATE users SET nombre='$fname', apellido='$lname', email='$email1',lugar='$lugar1',coordenada_x='$coordenada1',coordenada_y='$coordenada2',imagen='$imagen' WHERE user_id='$user_id'");
		return $res;
	}
}

?>