<?php

class Cour
{
    private ?int $id;
    private string $titre;
    private string $description;
    private ?string $images;
    private ?string $contenu;
    private $total_rows;
    private ?float $price;
    private ?int $categoryId;
    private ?string $videoUrl;
    private ?string $createdDate;
    private ?int $instructorId;
    private ?string $difficulty;
    private ?string $duration;
    private ?string $status;

    public function __construct($titre, $description, $contenu=null, $id = null, $price = null, $categoryId = null, $images = null, $videoUrl = null, $createdDate = null, $instructorId = null, $difficulty = null, $duration = null, $status = null)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->contenu = $contenu;
        $this->price = $price;
        $this->categoryId = $categoryId;
        $this->images = $images;
        $this->contenu = $contenu;
        $this->videoUrl = $videoUrl;
        $this->createdDate = $createdDate;
        $this->instructorId = $instructorId;
        $this->difficulty = $difficulty;
        $this->duration = $duration;
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
    public function gettitre(): string
    {
        return $this->titre;
    }
    public function settitre(string $titre): void
    {
        $this->titre = $titre;
    }
    public function getdescription(): string
    {
        return $this->description;
    }
    public function setdescription(string $description): void
    {
        $this->titre = $description;
    }
    public function getcontenu(): string|null
    {
        return $this->contenu;
    }
    public function setcontenu(string $contenu): void
    {
        $this->contenu = $contenu;
    }
    public function getimages(): ?string
    {
        return $this->images;
    }
    public function setimage(string $images): void
    {
        $this->images = $images;
    }
    public function getTotalRows()
    {
        return $this->total_rows;
    }
    public function setTotalRows($totalRows)
    {
        $this->total_rows = $totalRows;
    }
    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function setCategoryId(int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }
   
    public function getVideoUrl(): ?string
    {
        return $this->videoUrl;
    }

    public function setVideoUrl(?string $videoUrl): void
    {
        $this->videoUrl = $videoUrl;
    }

    public function getCreatedDate(): ?string
    {
        return $this->createdDate;
    }

    public function setCreatedDate(?string $createdDate): void
    {
        $this->createdDate = $createdDate;
    }

    public function getInstructorId(): int
    {
        return $this->instructorId;
    }

    public function setInstructorId(int $instructorId): void
    {
        $this->instructorId = $instructorId;
    }

    public function getDifficulty(): string
    {
        return $this->difficulty;
    }

    public function setDifficulty(string $difficulty): void
    {
        $this->difficulty = $difficulty;
    }

    public function getDuration(): string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): void
    {
        $this->duration = $duration;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
    public function setStatus(string $status): void
    {
        if (!in_array($status, ['pending', 'accepted', 'rejected'])) {
            throw new InvalidArgumentException("Statut invalide: $status");
        }
        $this->status = $status;
    }


}


















?>