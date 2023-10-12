<?php

namespace App\DataFixtures;

use App\Entity\Marque;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MarqueFixtures extends Fixture
{
    private $counter_m= 1
    ;
    public function load(ObjectManager $manager): void
    {

            $marques = [
                'Sony',
                'Microsoft',
                'Nintendo',
                'EA Sports',
                'Ubisoft',
                'Activision',
                'Square Enix',
                'Capcom',
                '2K Games',
                'Sega',
                'Bethesda',
                'Konami',
                'Bandai Namco',
                'Valve',
                'Rockstar Games',
                'Warner Bros. Interactive Entertainment',
                'Epic Games',
                'Blizzard Entertainment',
                'Riot Games',
            ];
        
           
            foreach ($marques as $nomMarque) {
                $this->createMarque($nomMarque, $manager);
            }
    
            $manager->flush();
        }
        
            public function createMarque(string $nomMarque, ObjectManager $manager)
            {
                $marque = new Marque();
                $marque->setNomMarque($nomMarque);
                $manager->persist($marque);
        
         $this->addReference('marque-'.$this->counter_m, $marque);
                $this->counter_m++;
                return $marque;
            }
        }

