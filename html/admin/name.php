<?php
include_once("../db_conn/config.php");
if (isset($_POST['Submit']))
 {
			$service_title = $_POST["service_title"];
		
			 $stmt_two=$db_conn->prepare("INSERT INTO price_list(service_title) VALUES (:myLocName)");
    		 $stmt_two->bindParam(':myLocName', $service_title);
    		 $stmt_two->execute();
 }


//CODE for ajax add inputs or Price Lists
$number = count($_POST["service_title"]);
$number = count($_POST["item"]);
$number = count($_POST["price"]);
if($number > 1)
{

	for($i=0; $i<$number; $i++)
	{
		if(trim($_POST["item"][$i]) != '' && trim($_POST["price"][$i]) != '')
		{

    		 $item_title = "Item";
			$price_title = "Price";
			$stmt=$db_conn->prepare("INSERT INTO price_list(service_title, item, price, item_title, price_title) VALUES ('".$_POST["service_title"][$i]."','".$_POST["item"][$i]."','".$_POST["price"][$i]."', '".$item_title."', '".$price_title."')");
			$stmt->execute();

		}
	}
	echo "Data Submitted!";
}else{
	echo "Please Add All Required Fields!";
}

//END CODE for ajax add inputs or Price Lists

?>
