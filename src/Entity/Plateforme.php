<?php

namespace App\Entity;

use App\Repository\PlateformeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlateformeRepository::class)]
class Plateforme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 24)]
    private ?string $libPlateforme = null;

    #[ORM\OneToMany(mappedBy: 'plateforme', targetEntity: JeuVideo::class, orphanRemoval: true)]
    private Collection $jeuVideo;

    public function __construct()
    {
        $this->jeuVideo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibPlateforme(): ?string
    {
        return $this->libPlateforme;
    }

    public function setLibPlateforme(string $libPlateforme): static
    {
        $this->libPlateforme = $libPlateforme;

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
            $jeuVideo->setPlateforme($this);
        }

        return $this;
    }

    public function removeJeuVideo(JeuVideo $jeuVideo): static
    {
        if ($this->jeuVideo->removeElement($jeuVideo)) {
            // set the owning side to null (unless already changed)
            if ($jeuVideo->getPlateforme() === $this) {
                $jeuVideo->setPlateforme(null);
            }
        }

        return $this;
    }
}
