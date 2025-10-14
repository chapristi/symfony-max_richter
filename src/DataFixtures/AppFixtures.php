<?php

namespace App\DataFixtures;

use App\Entity\Editeur;
use App\Entity\Genre;
use App\Entity\JeuVideo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $genreAction = new Genre();

        $genreAction->setNom('Action');
        $genreAction->setDescription('Jeux d\'action, de combat');
        $manager->persist($genreAction);

        $editeurSony = new Editeur();
        $editeurSony->setNom('Sony Interactive Entertainment');
        $editeurSony->setPays('Japon');
        $editeurSony->setSiteWeb('https://sie.com');
        $manager->persist( $editeurSony);

        $jeuVideo = new JeuVideo();
        $jeuVideo->setTitre('The last of us part II');
        $jeuVideo->setEditeur( $editeurSony);
        $jeuVideo->setGenre($genreAction);
        $jeuVideo->setDeveloppeur('Naughty Dog');
        $jeuVideo->setDateSortie(new \DateTime('2020-06-19'));
        $jeuVideo->setPrix(59.99);
        $manager->persist( $jeuVideo);

        $manager->flush();
    }
}
