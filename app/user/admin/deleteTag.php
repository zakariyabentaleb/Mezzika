<?php
require_once('C:\Users\youco\Desktop\iLearN-platform\app\model\impl\TagModelimpl.php');

$add=new TagModelimpl();
$name=$_POST['tag_id'];

$tags=$add->deleteTag($name);

header('location: ./Tags.php') ;

?>