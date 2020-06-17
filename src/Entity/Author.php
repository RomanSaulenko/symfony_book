<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AuthorRepository::class)
 * @UniqueEntity(
 *     fields={"name"},
 * )
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
     * @Assert\NotBlank(message="author.name.not_blank")
     * @ORM\Column(type="string", unique=true, length=150)
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
        $nameParts = explode(' ', $this->name);
        $surname = array_shift($nameParts);

        $fullname = $surname;
        foreach ($nameParts as $namePart) {
            $fullname .= ' ' . substr($namePart, 0, 1) . '.';
        }
        return $fullname;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
