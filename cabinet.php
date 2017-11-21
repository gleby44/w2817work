<?php
require_once('config/config.php');
if(!$_SESSION['user_id']){
	session_destroy();
	header('location:/login.php');
}
 ?>
<?php require_once ('templates/top.php');?>

    <section class="py-5">
      <div class="container">
        <h1>
			Кабинет пользователя
		</h1>
		<div class="table-responsive">
              <table class="table table-hover">
                  <thead>
                  <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>body</th>
                      <th>picture</th>
                      <th>price</th>
                      <th>putdate</th>
                      <th>product code</th>
                      <th>catalog id</th>
                      <th>user id</th>
                      <th>del</th>
                      <th>red</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $s_user_id=(int)$_SESSION['user_id'];
                  $query="SELECT * FROM products WHERE user_id=$s_user_id";
				  $adr=database($query);
                  ?>
                <?php while($prodict_list=mysqli_fetch_array($adr)) { ?>
                    <tr class="list">
                        <td><?php echo $prodict_list['id'] ?></td>
                        <td><?php echo $prodict_list['name'] ?></td>
                        <td><?php echo $prodict_list['body'] ?></td>
                        <td><?php echo $prodict_list['price'] ?></td>
                        <td><img src="vendor/uploads/<?php echo $prodict_list['picture'] ?>"/></td>
                        <td><?php echo $prodict_list['putdate'] ?></td>
                        <td><?php echo $prodict_list['product_code'] ?></td>
						<?php 
							$catalog_id=(int)$prodict_list['catalog_id'];
							$catalog_query="SELECT * FROM catalogs WHERE id=$catalog_id";
							$catalog_adr=database($catalog_query);
							$catalog_array=mysqli_fetch_array($catalog_adr);
						?>
                        <td><?php echo $catalog_array['name'] ?></td>
                        <td><?php echo $prodict_list['user_id'] ?></td>
						<td><a style="background:red" class="btn btn-primary" onclick="delet_position('<?php echo "delete.php?id=".$prodict_list['id'] ?>','Хотите удалить?')" href="#">delete</a></td>
                        <td><a class="btn btn-primary" href="rechange.php?id=<?php echo $prodict_list['id'] ?>">edit</a></td>
                    </tr>
                    <?php
                }
                    ?>
                  </tbody>
              </table>
			  </div>
		<form role="form" action="cabinet.php" method="post" enctype="multipart/form-data"> 
		<div class="form-group">
			<?php 
			if($_POST){
				$p_name=$_POST['name'];
				$p_body=$_POST['body'];
				$p_price=$_POST['price'];
				$p_catalog_id=(int)$_POST['catalog_id'];
				$errors=array();
				if(!$p_name){
					$errors[]='Поле name не заполнено';
				}
				if(!$p_body){
					$errors[]='Поле body не заполнено';
				}
				$p_body=str_replace('<script',"<span>script</span>",$p_body);
				$p_body=str_replace('</script>',"<span>script</span>",$p_body);
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
				$picture="";
					echo "no files";
				}
				$query="INSERT INTO products VALUES(
				NULL,
				'$p_name',
				'$p_body',
				'$picture',
				'$p_price',
				0,
				NOW(),
				'',
				'".date('ymdhis')."',
				'new',
				$p_catalog_id,
				".$_SESSION['user_id']."
				)";
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
			<input type="text" class="form-control" id="name" name="name" placeholder="name">
		  </div>
		  <div class="form-group">
			<label for="body">body</label>
			<textarea class="form-control" rows="3" name="body" id="body"></textarea>
		  </div>
		  <div class="form-group">
			<label for="price">Price</label>
			<input type="text" class="form-control" rows="3" name="price" id="price"/>
		  </div>
		  <div class="form-group">
			<label for="file">File input</label>
			<input type="file" id="file" name="file">
		  </div>
		  <div class="form-group">
			<select class="form-control" name="catalog_id">
				<?php
					$query="SELECT * FROM catalogs";
					$adr=database($query);
					while($cats=mysqli_fetch_array($adr)){
						?>
						<option value="<?php echo $cats['id'] ?>"><?php echo $cats['name'] ?></option>
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