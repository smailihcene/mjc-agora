<?php

namespace App\DataFixtures;

use App\Entity\Plateforme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class PlateformeFixtures extends Fixture
{
    private $counter_p = 1;
    
    public function load(ObjectManager $manager): void
    {

    $plateformes = [
        'PlayStation 5',
        'Xbox Series X',
        'Nintendo Switch',
        'PC',
        'PlayStation 4',
        'Xbox One',
        'PlayStation 3',
        'Xbox 360',
        'Wii U',
        'Nintendo 3DS',
        'Nintendo DS',
        'PlayStation Vita',
        'PSP',
        'iOS',
        'Android',
        'Mac',
        'Linux',
        'PlayStation 2',
        'Xbox',
        'GameCube',
    ];

    
        foreach ($plateformes as $libPlateforme) {
            $this->createPlateforme($libPlateforme, $manager);
        }

        $manager->flush();
    }

    public function createPlateforme(string $libPlateforme, ObjectManager $manager)
    {
        $plateforme = new Plateforme();
        $plateforme->setLibPlateforme($libPlateforme);
        $manager->persist($plateforme);

        $this->addReference('plateforme-'.$this->counter_p, $plateforme);
        $this->counter_p++;

        return $plateforme;
    }
}

