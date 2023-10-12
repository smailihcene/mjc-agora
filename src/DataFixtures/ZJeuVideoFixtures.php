<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\JeuVideo;

class ZJeuVideoFixtures extends Fixture
{
    private $counter_jv = 1;

    public function load(ObjectManager $manager): void
    {

        // Récupérez les références de vos fixtures
        $marques = [];
        $pegis = [];
        $genres = [];
        $plateformes = [];

        //tb jeu
        $jeuxNoms = [
            'Spider-Man: Miles Morales',
            'Cyberpunk 2077',
            'The Legend of Zelda: Breath of the Wild',
            'FIFA 22',
            'Halo Infinite',
            'Super Mario Odyssey',
            'Forza Horizon 5',
            'The Elder Scrolls VI',
            'Breath of the Wild 2',
            'Grand Theft Auto VI',
            'FIFA 23',
            'Super Mario Galaxy 3',
            'Forza Motorsport 8',
            'Call of Duty: Modern Warfare 2',
            'The Legend of Zelda: Twilight Princess HD',
            'Red Dead Redemption 3',
            'FIFA 24',
            'Super Mario 3D World + Bowsers Fury',
            'Forza Horizon 6',
            'Call of Duty: Black Ops V',
        ];
        
        
        $jeuxPrix = [
            59.99,
            49.99,
            59.99,
            59.99,
            59.99,
            49.99,
            59.99,
            59.99,
            59.99,
            59.99,
            59.99,
            49.99,
            59.99,
            59.99,
            49.99,
            59.99,
            59.99,
            49.99,
            59.99,
            59.99,
        ];
        

        //créer réference 

        for ($i = 1; $i <= 10; $i++) {
            $marques[] = $this->getReference('marque-' . $i);
            $genres[] = $this->getReference('genre-' . $i);
            $plateformes[] = $this->getReference('plateforme-' . $i);
        }

        for ($i = 1; $i <= 5; $i++) {
            $pegis[] = $this->getReference('pegi-' . $i);
        }

        // Créez des jeux vidéo avec les références
        for ($i = 1; $i <= 10; $i++) {
            $this->createJeuVideo(
                $marques[array_rand($marques)],
                $pegis[array_rand($pegis)],
                $genres[array_rand($genres)],
                $plateformes[array_rand($plateformes)],
                $jeuxNoms[$i-1],
                $jeuxPrix[$i-1],
                new \DateTimeImmutable('now')
                , $manager);
        }

        $manager->flush();
    }

    public function createJeuVideo($marque, $pegi, $genre, $plateforme, $nom, $prix, $dateParution, ObjectManager $manager)
    {
        $jeuVideo = new JeuVideo();
        $jeuVideo->setMarque($marque)
            ->setPegi($pegi)
            ->setGenre($genre)
            ->setPlateforme($plateforme)
            ->setNom($nom)
            ->setPrix($prix)
            ->setDateParution($dateParution);

        $manager->persist($jeuVideo);

        $this->addReference('jeu_video-' . $this->counter_jv, $jeuVideo);
        $this->counter_jv++;

        return $jeuVideo;
    }
}