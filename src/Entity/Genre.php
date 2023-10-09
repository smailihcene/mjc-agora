<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenreRepository::class)]
class Genre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 24)]
    private ?string $libGenre = null;

    #[ORM\OneToMany(mappedBy: 'genre', targetEntity: JeuVideo::class, orphanRemoval: true)]
    private Collection $jeuVideo;

    public function __construct()
    {
        $this->jeuVideo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibGenre(): ?string
    {
        return $this->libGenre;
    }

    public function setLibGenre(string $libGenre): static
    {
        $this->libGenre = $libGenre;

        return $this;
    }

    /**
     * @return Collection<int, JeuVideo>
     */
    public function getJeuVideo(): Collection
    {
        return $this->jeuVideo;
    }

    public function addJeuVideo(JeuVideo $jeuVideo): static
    {
        if (!$this->jeuVideo->contains($jeuVideo)) {
            $this->jeuVideo->add($jeuVideo);
            $jeuVideo->setGenre($this);
        }

        return $this;
    }

    public function removeJeuVideo(JeuVideo $jeuVideo): static
    {
        if ($this->jeuVideo->removeElement($jeuVideo)) {
            // set the owning side to null (unless already changed)
            if ($jeuVideo->getGenre() === $this) {
                $jeuVideo->setGenre(null);
            }
        }

        return $this;
    }
}
