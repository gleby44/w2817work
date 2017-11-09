<?php require_once ('templates/top.php');?>

<div class="container" action="register.php">
	<form class="form-horizontal top" method="post" >
	<div>
		<?php if($_POST){
			$p_name=$_POST['name'];
			$p_email=$_POST['email'];
			$p_passw=$_POST['passw'];
			$p_passwagain=$_POST['passwagain'];
			$errors=array();
			if(!$p_name){
				$errors[]='Поле name не заполнено';
			}
			if(!$p_email){
				$errors[]='Поле email не заполнено';
			}
			$search="SELECT * FROM users WHERE email='$p_email'";
			$srch=database($search);
			$serch_array=mysqli_fetch_array($srch);
			if(!empty($serch_array)){
				$errors[]='email уже зарегестрирован';
			}
			if(!$p_passw){
				$errors[]='Поле пароль не заполнено';
			}
			if(!$p_passwagain){
				$errors[]='Поле повторите пороль не заполнено';
			}
			if($p_passw!=$p_passwagain){
				$errors[]='Пароли не совпадают';
			}
			if(!empty($errors)){
				echo '<ul class="errors">';
				foreach($errors as $error){
					echo "<li>$error</li>";
				}
				echo '</ul>';
			}else{
				$query="INSERT INTO users VALUES(
					NULL,
					'$p_name',
					'$p_email',
					'$p_passw',
					'unblock',
					NOW(),
					NOW()
				)";
				$adr=database($query);
				?>
				<script type="text/javascript">
					document.location.href="login.php";
				</script>
			<?php }
		}
		?>
	</div>
	  <fieldset>
		<legend>Register</legend>
		<div class="form-group">
		  <label for="name" class="col-lg-2 control-label">Name</label>
		  <div class="col-lg-10">
			<input type="text" class="form-control" id="name" name="name" placeholder="Name">
		  </div>
		</div>
		<div class="form-group">
		  <label for="email" class="col-lg-2 control-label">Email</label>
		  <div class="col-lg-10">
			<input type="text" class="form-control" id="email" name="email" placeholder="Email">
		  </div>
		</div>
		<div class="form-group">
		  <label for="passw" class="col-lg-2 control-label">Password</label>
		  <div class="col-lg-10">
			<input type="password" class="form-control" id="passw" name="passw" placeholder="Password">
		  </div>
		</div>
		<div class="form-group">
		  <label for="passwagain" class="col-lg-2 control-label">Password</label>
		  <div class="col-lg-10">
			<input type="password" class="form-control" id="passwagain" name="passwagain" placeholder="Password">
		  </div>
		</div>
		<div class="form-group">
		  <div class="col-lg-10 col-lg-offset-2">
			<button type="reset" class="btn btn-default">Cancel</button>
			<button type="submit" class="btn btn-primary">Submit</button>
		  </div>
		</div>
		<a href="login.php">Уже есть аккаунт?</a>
	  </fieldset>
	</form>
</div>
<?php require_once ('templates/bottom.php');?>