<?php require_once ('config/config.php');
$p_url=$_POST['url'];
$query="SELECT * FROM maintexts WHERE url='$p_url'";
$adr=database($query);
$arr=mysqli_fetch_array($adr);
//explode('=',str);азбиение строки на 2ва массива
?>
<p>
<? echo $arr['name'];?>
</p>
<?echo $arr['body'];?>
