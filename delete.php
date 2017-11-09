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
	$query="SELECT * FROM products WHERE id=$id";
	$adr=database($query);
	$pic=mysqli_fetch_array($adr); //удаление файла с сервера 
	if($pic['picture']){
		$file='vendor/uploads/'.$pic['picture'];
		if(file_exists($file)){
			@unlink($file);  //функция удаления ставим собаку т.к работает некорректно
		}
	}
	$query ="DELETE FROM products WHERE id = $id AND user_id='".$_SESSION['user_id']."'";
	$adr=database($query);
?>
		<script>
			document.location.href="cabinet.php";
		</script>
<?php
						  
						  
