<?php
require_once('config/config.php');
if(!$_SESSION['user_id']){
	session_destroy();
	header('location:/login.php');
}
	if(isset($_GET['id'])){
		$id=(int)$_GET['id'];
	}else{
		exit('id не найден');
	} 
 ?>
<?php require_once ('templates/top.php');?>

    <section class="py-5">
      <div class="container">
	  <?php
		$query="SELECT * FROM products WHERE id=$id";
		$adr=database($query);
		$re_arr=mysqli_fetch_array($adr);
	  ?>
        <h1>
			Редактирование <?php echo $re_arr['name']?>
		</h1>
		<form role="form" action="<?php echo "rechange.php?id=".$id ?>" method="post" enctype="multipart/form-data"> 
		<div class="form-group">
			<?php
			if($_POST){
				$p_name=$_POST['name'];
				$p_body=$_POST['body'];
				$p_price=$_POST['price'];
				$p_catalog_id=(int)$_POST['catalog_id'];
				$picture=$re_arr['picture'];
				$errors=array();
				if(!$p_name){
					$errors[]='Поле name не заполнено';
				}
				if(!$p_body){
					$errors[]='Поле body не заполнено';
				}
				if(!$p_price){
					$errors[]='Поле price не заполнено';
				}
				if(!empty($errors)){
				echo '<ul class="errors">';
				foreach($errors as $error){
					echo "<li>$error</li>";
				}
				echo '</ul>';
				}else{
				if($_FILES){
					$file_name_tmp=$_FILES['file']['tmp_name'];
					$dir='/vendor/uploads/';
					$file_new_name=$_SERVER['DOCUMENT_ROOT'].$dir;
					//$picture=date('y_m_d_h_i_s').'.jpg';
					$picture=$_FILES['file']['name'];
					if(move_uploaded_file($file_name_tmp,$file_new_name.$picture)){
						$ok=true;
					}
				}
				else{
					$picture=$re_arr['picture'];
				}
				$query="UPDATE products SET name='$p_name', body='$p_body', price='$p_price', catalog_id='$p_catalog_id', picture='$picture' WHERE id=$id";
				$adr=database($query);
				?>
				<script>
					document.location.href="cabinet.php";
				</script>
				<?php
				
				}
			}
			?>
		</div>
		  <div class="form-group">
			<label for="name">name</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="name" value="<?php echo $re_arr['name'];?>">
		  </div>
		  <div class="form-group">
			<label for="body">body</label>
			<textarea class="form-control" rows="3" name="body" id="body"><?php echo $re_arr['body']?></textarea>
		  </div>
		  <div class="form-group">
			<label for="price">Price</label>
			<input type="text" class="form-control" rows="3" name="price" id="price" value="<?php echo $re_arr['price']?>"/>
		  </div>
		  <div class="form-group">
			<label for="file"><img src="vendor/uploads/<?php echo $re_arr['picture'] ?>" style="width:100px"/></label>
			<input type="file" id="file" name="file">
		  </div>
		  <div class="form-group">
			<select class="form-control" name="catalog_id">
				<?php
					$query="SELECT * FROM catalogs";
					$adr=database($query);
					while($cats=mysqli_fetch_array($adr)){
						?>
						<option value="<?php echo $cats['id'] ?>"
						<?php if($cats['id']==$re_arr['catalog_id'])echo 'selected' ?>><?php echo $cats['name'] ?></option>
						<?php
					}
				?>
			</select>
		  </div>
		  
		  <button type="submit" class="btn btn-default">Отправить</button>
		</form>
      </div>
    </section>
	<?php require_once ('templates/bottom.php');?>