<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Genre;

class GenreFixtures extends Fixture
{
    private $counter_g = 1;

    public function load(ObjectManager $manager): void
    {
        $genres = [
            'Action',
            'Aventure',
            'RPG',
            'Sport',
            'Course',
            'StratÃ©gie',
            'Simulation',
            'Horreur',
            'FPS',
            'TPS',
            'Puzzle',
            'Combat',
            'Musical',
            'Plateforme',
            'Survie',
            'Monde ouvert',
            'Sandbox',
            'Rogue-like',
            'Tir',
            'Exploration',
        ];

        foreach ($genres as $libGenre) {
            $this->createGenre($libGenre, $manager);
        }

        $manager->flush();
    }

    public function createGenre(string $libGenre, ObjectManager $manager)
    {
        $genre = new Genre();
        $genre->setLibGenre($libGenre);
        $manager->persist($genre);

        $this->addReference('genre-'.$this->counter_g, $genre);
        $this->counter_g++;

        return $genre;
    }
}
