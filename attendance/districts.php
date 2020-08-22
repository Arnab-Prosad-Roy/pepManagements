<?php

 $conn = mysqli_connect("localhost", "kealcom", "Cought#2{Red&Handed}@Salehn", "kealcom_recruitment");

$division = $_GET['division'];

if(!empty($division)){
echo "SELECT * FROM tbl_district WHERE divId = '$division'";
$districts = mysqli_query($conn, "SELECT * FROM tbl_district WHERE divId = '$division'");
foreach($districts as $res_dis){
	
echo '<option value='.$res_dis['distId'].'>'.$res_dis['distName'].'</option>';
}
}else{
echo 'Error';
}

?>