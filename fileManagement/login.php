<?php include 'header.php';?>

<?php 
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login'])) {
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$signin = $log->employeelogin($email, $pass);
}
?>
<body>

<div class="limiter">
		<div class="container-login100" style="background-image: url('limages/bg-01.jpg');">
		     
			<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
			   <h3 style="text-align-center">File Management</h3>
			   <br><br/>
			<?php 
			if(isset($signin)){
				echo ($signin);
			}
			?>
				<form action="" method="post" class="login100-form validate-form flex-sb flex-w">
				<!-- 	<span class="login100-form-title p-b-53">
						Sign In With
					</span>

					<a href="#" class="btn-face m-b-20">
						<i class="fa fa-facebook-official"></i>
						Facebook
					</a>

					<a href="#" class="btn-google m-b-20">
						<img src="images/icons/icon-google.png" alt="GOOGLE">
						Google
					</a> -->
					
					<div class="p-t-31 p-b-9">
						<span class="txt1">
							Username
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Username is required">
						<input class="input100" type="email" name="email" >
						<span class="focus-input100"></span>
					</div>
					
					<div class="p-t-13 p-b-9">
						<span class="txt1">
							Password
						</span>

						<a href="#" class="txt2 bo1 m-l-5">
							<!--Forgot?-->
						</a>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" >
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button type="submit" name="login" class="login100-form-btn" style="height: 42px;">
							Sign In
						</button>
					</div>

					<div class="w-full text-center p-t-55">
						<!--<span class="txt2">-->
						<!--	Not a member?-->
						<!--</span>-->

						<!--<a href="#" class="txt2 bo1">-->
						<!--	Sign up now-->
						<!--</a>-->
					</div>
				</form>
			</div>
		</div>
	</div>
	

</body>
<?php include 'footer.php';?>