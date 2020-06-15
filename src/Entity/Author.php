<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AuthorRepository::class)
 */
class Author
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=150)
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getNameInitials()
    {
        list($surname, $name, $partronymic) = explode(' ', $this->name);

        return $surname . ' ' . substr($name, 0, 1) . '. ' . substr($partronymic, 0, 1) . '.';
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
