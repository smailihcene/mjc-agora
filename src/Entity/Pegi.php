<?php

namespace App\Entity;

use App\Repository\PegiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PegiRepository::class)]
class Pegi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $ageLimite = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descPegi = null;

    #[ORM\OneToMany(mappedBy: 'pegi', targetEntity: JeuVideo::class, orphanRemoval: true)]
    private Collection $jeuVideo;

    public function __construct()
    {
        $this->jeuVideo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAgeLimite(): ?int
    {
        return $this->ageLimite;
    }

    public function setAgeLimite(int $ageLimite): static
    {
        $this->ageLimite = $ageLimite;

        return $this;
    }

    public function getDescPegi(): ?string
    {
        return $this->descPegi;
    }

    public function setDescPegi(?string $descPegi): static
    {
        $this->descPegi = $descPegi;

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
            $jeuVideo->setPegi($this);
        }

        return $this;
    }

    public function removeJeuVideo(JeuVideo $jeuVideo): static
    {
        if ($this->jeuVideo->removeElement($jeuVideo)) {
            // set the owning side to null (unless already changed)
            if ($jeuVideo->getPegi() === $this) {
                $jeuVideo->setPegi(null);
            }
        }

        return $this;
    }
}
