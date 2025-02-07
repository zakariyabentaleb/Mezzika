<?php

class Song
{
    private ?int $id;
    private string $title;
    private ?string $genre;
    private ?string $releaseDate;
    private ?string $filePath;
    private ?int $artistId;

    public function __construct(
        $title, 
        $genre = null, 
        $releaseDate = null, 
        $filePath = null, 
        $artistId = null,  
        $id = null
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->genre = $genre;
        $this->releaseDate = $releaseDate;
        $this->filePath = $filePath;
        $this->artistId = $artistId;
        $this->status = $status;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): void
    {
        $this->genre = $genre;
    }

    public function getReleaseDate(): ?string
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(?string $releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

    public function setFilePath(?string $filePath): void
    {
        $this->filePath = $filePath;
    }

    public function getArtistId(): ?int
    {
        return $this->artistId;
    }

    public function setArtistId(?int $artistId): void
    {
        $this->artistId = $artistId;
    }

}
















?>