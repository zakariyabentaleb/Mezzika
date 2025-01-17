<?php

  interface CourModel
{
    public function addCour(Cour $cour): bool;

    public function deleteCour(int $id ): void;

    public function updateCour(Cour $cour): void;

    public function searchCour(string $titre): array;

    public function countCour(): int;

    public function getAllCours(): array ;

    public function getCourseById( int $id) : array ;

    public function getCourseTeacher(  int $id) : array ;

    public function getCoursetags( int $id) : array ;
}
?>