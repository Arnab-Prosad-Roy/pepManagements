<?php

$conn = mysqli_connect("localhost", "kealcom", "Cought#2{Red&Handed}@Salehn", "kealcom_recruitment");

$district = $_GET['pdistrict'];
//echo 'Dis id is :'.$district;

if(!empty($district)){
	echo "SELECT * FROM tbl_thana WHERE distId = '$district'";

	$districts = mysqli_query($conn, "SELECT * FROM tbl_thana WHERE distId = '$district'");
	foreach($districts as $res_dis){
		echo '<option value='.$res_dis['thId'].'>'.$res_dis['thName'].'</option>';
	}
}else{
		echo 'Error';
	}

?>