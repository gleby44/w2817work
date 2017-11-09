<?php require_once ('templates/top.php');?>

<div class="container" action="login.php">
	<form class="form-horizontal top" method="post" >
	<div>
		<?php if($_POST){
			$p_email=$_POST['email'];
			$p_passw=$_POST['passw'];
			$errors=array();
			if(!$p_email){
				$errors[]='Поле email не заполнено';
			}
			if(!$p_passw){
				$errors[]='Поле пароль не заполнено';
			}
			if(!empty($errors)){
				echo '<ul class="errors">';
				foreach($errors as $error){
					echo "<li>$error</li>";
				}
				echo '</ul>';
			}else{
			$query="SELECT * FROM users WHERE email='$p_email' AND password='$p_passw'";
			$adr=database($query);
			$result_arr=mysqli_fetch_array($adr);
			if(empty($result_arr)){
				echo 'Неправильный логин или пароль';
			}
			else{
				$user= $result_arr['id'];
				$_SESSION['user_id']=$user;
				$_SESSION['user_name']=$result_arr['name'];;
				?>
				<script type="text/javascript">
					document.location.href="index.php";
				</script>
				<?php
				}
			}
		}
		?>
	</div>
	  <fieldset>
		<legend>login</legend>
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
		  <div class="col-lg-10 col-lg-offset-2">
			<button type="reset" class="btn btn-default">Cancel</button>
			<button type="submit" class="btn btn-primary">login</button>
		  </div>
		</div>
		<a href="register.php">Не зарегестрированы?</a>
	  </fieldset>
	</form>
</div>
<?php require_once ('templates/bottom.php');?>