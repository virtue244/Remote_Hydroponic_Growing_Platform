<?php
$db_host='localhost';
$db_user='dylan';
$db_pass='raspberry';
$db_name='mydb';
$errors = array();
$forgot_password_errors = array();
try{
	$db_conn = new PDO("mysql:host={$db_host};dbname={$db_name}", $db_user, $db_pass);
	$db_conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
	echo $e->getMessage();
}
?>