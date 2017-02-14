<?php


if($_GET['page'])
{
	$page=$_GET['page'];
	include 'body/'.$page.'.php';
}
else
{
	include 'body/index.php';
}
?>