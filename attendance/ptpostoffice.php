<?php

$conn = mysqli_connect("localhost", "kealcom", "Cought#2{Red&Handed}@Salehn", "kealcom_recruitment");

$upazila = $_GET['pupazila'];
if(!empty($upazila)){
	echo "SELECT * FROM tbl_post WHERE distId = '$upazila'";

	$upazilas = mysqli_query($conn, "SELECT * FROM tbl_post WHERE distId = '$upazila'");
	foreach($upazilas as $res_dis){
		echo '<option value='.$res_dis['postId'].'>'.$res_dis['postName'].'</option>';
	}
}else{
	echo 'Error';
}

?>