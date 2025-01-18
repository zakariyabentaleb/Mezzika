<?php
interface TagModel
{
    public function createTag(string $name) : string ;

    public function getTags(): array;

    public function deleteTag(int $id) : bool ;
    
}
?>