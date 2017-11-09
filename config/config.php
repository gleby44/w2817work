<?php
session_start();
$title='K.R.O.S.S shop';
$description='Описание сайта 1,2,3 предложение до 225символов';
$keywords='Выражения через запятую, слова в поисковых запросах';
$email='gleby4383571@gmail.com';
$logo='vendor/images/logo.png';

$db_location='localhost';
$db_user='root';
$db_pass="";
$db_name="autopodbor";
$db_con=mysqli_connect($db_con,$db_user,$db_pass,$db_name);

if(!$db_con){
	exit('Error');
}
mysqli_query($db_con, "SET NAMES 'utf-8'");


function database($arg){
	global $db_con;
	$ar=mysqli_query($db_con,$arg);
	if(!$ar){
		exit('Ошибка получения данных');
	}
	return $ar;
}