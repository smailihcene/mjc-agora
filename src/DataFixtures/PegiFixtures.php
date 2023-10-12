<?php

// src/DataFixtures/PegiFixtures.php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Pegi;

class PegiFixtures extends Fixture
{
    private $counter_pegi = 1;

public function load(ObjectManager $manager): void{

    $pegis = [
        [
            'age_limite' => 3,
            'desc_pegi' => 'Convient aux enfants de 3 ans et plus',
        ],
        [
            'age_limite' => 7,
            'desc_pegi' => 'Convient aux enfants de 7 ans et plus',
        ],
        [
            'age_limite' => 12,
            'desc_pegi' => 'Convient aux personnes de 12 ans et plus',
        ],
        [
            'age_limite' => 16,
            'desc_pegi' => 'Convient aux personnes de 16 ans et plus',
        ],
        [
            'age_limite' => 18,
            'desc_pegi' => 'Réservé aux adultes de 18 ans et plus',
        ],
    ];

    
    
        foreach ($pegis as $pegiData) {
            $this->createPegi($pegiData, $manager);
        }

        $manager->flush();
    }

    public function createPegi(array $pegiData, ObjectManager $manager)
    {
        $pegi = new Pegi();
        $pegi->setAgeLimite($pegiData['age_limite']);
        $pegi->setDescPegi($pegiData['desc_pegi']);
        $manager->persist($pegi);

        $this->addReference('pegi-'.$this->counter_pegi, $pegi);
        $this->counter_pegi++;

        return $pegi;
    }
}