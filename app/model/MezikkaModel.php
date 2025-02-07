<?php

  interface MezikkaModel
{
  public function addSong(Song $song);

    public function deleteMezikka(int $id ): void;

    public function updateSong(Song $song) : void;

    public function searchMezikka(string $titre): array;

    public function countMezikka(): int;

    public function getAllMezikka(int $page , int $itemsPerPage ): array ;

    public function getAllMezikka( ): array ;

    public function getMezikkaById( int $id) : array ;

    public function getMezikkaArtist(  int $id) : array ;

}
?>