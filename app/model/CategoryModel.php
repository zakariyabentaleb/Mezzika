<?php

  interface CategoryModel
{
    public function createCategory( string $name): string ;
    public function getCategories() :array ;
    public function deleteCategory(int $id): bool  ;
}
?>