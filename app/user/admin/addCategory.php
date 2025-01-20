<?php
require_once('C:\Users\youco\Desktop\iLearN-platform\app\model\impl\CategoryModelimpl.php');

$add=new CategoryModelimpl();
$name=$_POST['category_id'];
$tags=$add->createCategory($name);
header('location: ./Category.php') ;

?>