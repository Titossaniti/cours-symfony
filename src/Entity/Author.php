<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuthorRepository::class)]
class Author
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Book>
     */
    #[ORM\OneToMany(targetEntity: Book::class, mappedBy: 'author')]
    private Collection $authorname;

    #[ORM\Column(length: 255)]
    private ?string $biography = null;

    public function __construct()
    {
        $this->authorname = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Book>
     */
    public function getAuthorname(): Collection
    {
        return $this->authorname;
    }

    public function addAuthorname(Book $authorname): static
    {
        if (!$this->authorname->contains($authorname)) {
            $this->authorname->add($authorname);
            $authorname->setAuthor($this);
        }

        return $this;
    }

    public function removeAuthorname(Book $authorname): static
    {
        if ($this->authorname->removeElement($authorname)) {
            // set the owning side to null (unless already changed)
            if ($authorname->getAuthor() === $this) {
                $authorname->setAuthor(null);
            }
        }

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(string $biography): static
    {
        $this->biography = $biography;

        return $this;
    }
}
