<?php
$db_host='localhost';
$db_user='root';
$db_pass='Okmijn1029';
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