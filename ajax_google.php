<?php require_once ('config/config.php');
require_once ('phpQuery/phpQuery/phpQuery.php');
$query="SELECT * FROM products WHERE picture=''";
$adr=database($query);
while($prod = mysqli_fetch_array($adr)){
	echo $prod['name'];
	$str=ereg_replace(' ','+',$prod['name']);
	$url="http://www.google.by/search?q=$str&source=lnms&tbm=isch&sa=X&ved=0ahUKEwjCsd_ozMPXAhWIChoKHbEkDo0Q_AUICygC&biw=1920&bih=949";
	$hap=file_get_contents($url);
	
	$document =phpQuery::newDocument($hap);
	$hentry=$document->find('.images_table img:first');
	$src=$document->find('.images_table img:first')->attr('src');
	echo $hentry;
	echo $src;
	$dir=$_SERVER['DOCUMENT_ROOT'].'/vendor/uploads/';
	$newfile=date('y_m_d_h_i_s').'jpg';
	if(copy($src, $dir.$newfile)){
		$query1="UPDATE products SET picture='$newfile' WHERE id=".(int)$prod['id'];
		$adr1=database($query1);
	}
	else{
		echo 'не удалось скопировать '.$src;
	}
	
	echo '<hr/>';
	sleep(1);
	//$_SERVER['REMOTE_ADDR']='127.0.0.1';
}