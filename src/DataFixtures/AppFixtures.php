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
        // ========== GENRES ==========

        // Genre Action
        $genreAction = new Genre();
        $genreAction->setNom('Action');
        $genreAction->setDescription('Jeux d\'action, de combat');
        $manager->persist($genreAction);

        // Genre Aventure
        $genreAventure = new Genre();
        $genreAventure->setNom('Aventure');
        $genreAventure->setDescription('Jeux d\'aventures');
        $manager->persist($genreAventure);

        // Genre Action-Aventure
        $genreActionAventure = new Genre();
        $genreActionAventure->setNom('Action-Aventure');
        $genreActionAventure->setDescription('Jeux d\'aventure et action');
        $manager->persist($genreActionAventure);

        // Genre RPG
        $genreRPG = new Genre();
        $genreRPG->setNom('RPG');
        $genreRPG->setDescription('Jeux de rôle');
        $manager->persist($genreRPG);

        // Genre Stratégie
        $genreStrategie = new Genre();
        $genreStrategie->setNom('Stratégie');
        $genreStrategie->setDescription('Jeux de stratégie et tactique');
        $manager->persist($genreStrategie);

        // Genre Simulation
        $genreSimulation = new Genre();
        $genreSimulation->setNom('Simulation');
        $genreSimulation->setDescription('Jeux de simulation');
        $manager->persist($genreSimulation);

        // Genre Sport
        $genreSport = new Genre();
        $genreSport->setNom('Sport');
        $genreSport->setDescription('Jeux de sport');
        $manager->persist($genreSport);

        // Genre Course
        $genreCourse = new Genre();
        $genreCourse->setNom('Course');
        $genreCourse->setDescription('Jeux de course automobile');
        $manager->persist($genreCourse);

        // Genre Réflexion
        $genreReflexion = new Genre();
        $genreReflexion->setNom('Réflexion');
        $genreReflexion->setDescription('Jeux de puzzle et réflexion');
        $manager->persist($genreReflexion);

        // ========== ÉDITEURS ==========

        $editeurSony = new Editeur();
        $editeurSony->setNom('Sony Interactive Entertainment');
        $editeurSony->setPays('Japon');
        $editeurSony->setSiteWeb('https://sie.com');
        $manager->persist($editeurSony);

        $editeurNintendo = new Editeur();
        $editeurNintendo->setNom('Nintendo');
        $editeurNintendo->setPays('Japon');
        $editeurNintendo->setSiteWeb('https://nintendo.com');
        $manager->persist($editeurNintendo);

        $editeurEA = new Editeur();
        $editeurEA->setNom('Electronic Arts');
        $editeurEA->setPays('États-Unis');
        $editeurEA->setSiteWeb('https://ea.com');
        $manager->persist($editeurEA);

        $editeurMicrosoft = new Editeur();
        $editeurMicrosoft->setNom('Microsoft');
        $editeurMicrosoft->setPays('États-Unis');
        $editeurMicrosoft->setSiteWeb('https://microsoft.com');
        $manager->persist($editeurMicrosoft);

        $editeurUbisoft = new Editeur();
        $editeurUbisoft->setNom('Ubisoft');
        $editeurUbisoft->setPays('France');
        $editeurUbisoft->setSiteWeb('https://ubisoft.com');
        $manager->persist($editeurUbisoft);

        // ========== JEUX VIDÉO ==========

        // Action
        $jeuVideo1 = new JeuVideo();
        $jeuVideo1->setTitre('The Last of Us Part II');
        $jeuVideo1->setEditeur($editeurSony);
        $jeuVideo1->setGenre($genreAction);
        $jeuVideo1->setDeveloppeur('Naughty Dog');
        $jeuVideo1->setDateSortie(new \DateTime('2020-06-19'));
        $jeuVideo1->setPrix(59.99);
        $manager->persist($jeuVideo1);

        // RPG
        $jeuVideo2 = new JeuVideo();
        $jeuVideo2->setTitre('The Witcher 3: Wild Hunt');
        $jeuVideo2->setEditeur($editeurUbisoft);
        $jeuVideo2->setGenre($genreRPG);
        $jeuVideo2->setDeveloppeur('CD Projekt Red');
        $jeuVideo2->setDateSortie(new \DateTime('2015-05-19'));
        $jeuVideo2->setPrix(39.99);
        $manager->persist($jeuVideo2);

        // Stratégie
        $jeuVideo3 = new JeuVideo();
        $jeuVideo3->setTitre('Age of Empires IV');
        $jeuVideo3->setEditeur($editeurMicrosoft);
        $jeuVideo3->setGenre($genreStrategie);
        $jeuVideo3->setDeveloppeur('Relic Entertainment');
        $jeuVideo3->setDateSortie(new \DateTime('2021-10-28'));
        $jeuVideo3->setPrix(49.99);
        $manager->persist($jeuVideo3);

        // Simulation
        $jeuVideo4 = new JeuVideo();
        $jeuVideo4->setTitre('Microsoft Flight Simulator');
        $jeuVideo4->setEditeur($editeurMicrosoft);
        $jeuVideo4->setGenre($genreSimulation);
        $jeuVideo4->setDeveloppeur('Asobo Studio');
        $jeuVideo4->setDateSortie(new \DateTime('2020-08-18'));
        $jeuVideo4->setPrix(69.99);
        $manager->persist($jeuVideo4);

        // Sport
        $jeuVideo5 = new JeuVideo();
        $jeuVideo5->setTitre('FIFA 24');
        $jeuVideo5->setEditeur($editeurEA);
        $jeuVideo5->setGenre($genreSport);
        $jeuVideo5->setDeveloppeur('EA Sports');
        $jeuVideo5->setDateSortie(new \DateTime('2023-09-29'));
        $jeuVideo5->setPrix(69.99);
        $manager->persist($jeuVideo5);

        // Course
        $jeuVideo6 = new JeuVideo();
        $jeuVideo6->setTitre('Mario Kart 8 Deluxe');
        $jeuVideo6->setEditeur($editeurNintendo);
        $jeuVideo6->setGenre($genreCourse);
        $jeuVideo6->setDeveloppeur('Nintendo EPD');
        $jeuVideo6->setDateSortie(new \DateTime('2017-04-28'));
        $jeuVideo6->setPrix(59.99);
        $manager->persist($jeuVideo6);

        // Réflexion
        $jeuVideo7 = new JeuVideo();
        $jeuVideo7->setTitre('Portal 2');
        $jeuVideo7->setEditeur($editeurEA);
        $jeuVideo7->setGenre($genreReflexion);
        $jeuVideo7->setDeveloppeur('Valve');
        $jeuVideo7->setDateSortie(new \DateTime('2011-04-19'));
        $jeuVideo7->setPrix(19.99);
        $manager->persist($jeuVideo7);

        // Action-Aventure
        $jeuVideo8 = new JeuVideo();
        $jeuVideo8->setTitre('The Legend of Zelda: Breath of the Wild');
        $jeuVideo8->setEditeur($editeurNintendo);
        $jeuVideo8->setGenre($genreActionAventure);
        $jeuVideo8->setDeveloppeur('Nintendo EPD');
        $jeuVideo8->setDateSortie(new \DateTime('2017-03-03'));
        $jeuVideo8->setPrix(59.99);
        $manager->persist($jeuVideo8);

        $manager->flush();
    }
}

