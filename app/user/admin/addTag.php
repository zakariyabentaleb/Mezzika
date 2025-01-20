<?php
require_once('C:\Users\youco\Desktop\iLearN-platform\app\model\impl\TagModelimpl.php');

$add=new TagModelimpl();
$name=$_POST['tagName'];
$tags=$add->createTag($name);
header('location: ./Tags.php') ;

?>