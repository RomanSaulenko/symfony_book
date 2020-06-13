<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $isbn;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $year_created;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $page_count;

    /**
     * @ORM\OneToMany(targetEntity=BookImage::class, mappedBy="book_id")
     */
    private $images;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $no;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getYearCreated(): ? DateTimeInterface
    {
        return $this->year_created;
    }

    public function setYearCreated(? DateTimeInterface $year_created): self
    {
        $this->year_created = $year_created;

        return $this;
    }

    public function getPageCount(): ?int
    {
        return $this->page_count;
    }

    public function setPageCount(?int $page_count): self
    {
        $this->page_count = $page_count;

        return $this;
    }

    /**
     * @return Collection|BookImage[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(BookImage $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setBookId($this);
        }

        return $this;
    }

    public function removeImage(BookImage $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getBookId() === $this) {
                $image->setBookId(null);
            }
        }

        return $this;
    }

    public function getNo(): ?string
    {
        return $this->no;
    }

    public function setNo(?string $no): self
    {
        $this->no = $no;

        return $this;
    }
}
