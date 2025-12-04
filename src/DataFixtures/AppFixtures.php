<?php

namespace App\DataFixtures;

use App\Entity\Collect;
use App\Entity\Developpeur;
use App\Entity\Editeur;
use App\Entity\Genre;
use App\Entity\JeuVideo;
use App\Entity\Utilisateur;
use App\Enum\StatutJeuEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\UserFixtures;
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

        // ========== DÉVELOPPEURS ==========

        // Naughty Dog
        $devNaughtyDog = new Developpeur();
        $devNaughtyDog->setNom('Naughty Dog');
        $devNaughtyDog->setPays('États-Unis');
        $devNaughtyDog->setSiteWeb('https://naughtydog.com');
        $devNaughtyDog->setDescription('Studio américain célèbre pour Uncharted et The Last of Us');
        $manager->persist($devNaughtyDog);

        // CD Projekt Red
        $devCDPR = new Developpeur();
        $devCDPR->setNom('CD Projekt Red');
        $devCDPR->setPays('Pologne');
        $devCDPR->setSiteWeb('https://cdprojektred.com');
        $devCDPR->setDescription('Studio polonais créateur de The Witcher et Cyberpunk 2077');
        $manager->persist($devCDPR);

        // Relic Entertainment
        $devRelic = new Developpeur();
        $devRelic->setNom('Relic Entertainment');
        $devRelic->setPays('Canada');
        $devRelic->setSiteWeb('https://relic.com');
        $devRelic->setDescription('Studio canadien spécialisé dans les jeux de stratégie en temps réel');
        $manager->persist($devRelic);

        // Asobo Studio
        $devAsobo = new Developpeur();
        $devAsobo->setNom('Asobo Studio');
        $devAsobo->setPays('France');
        $devAsobo->setSiteWeb('https://asobostudio.com');
        $devAsobo->setDescription('Studio français connu pour Microsoft Flight Simulator et A Plague Tale');
        $manager->persist($devAsobo);

        // EA Sports
        $devEASports = new Developpeur();
        $devEASports->setNom('EA Sports');
        $devEASports->setPays('États-Unis');
        $devEASports->setSiteWeb('https://easports.com');
        $devEASports->setDescription('Division d\'Electronic Arts spécialisée dans les jeux de sport');
        $manager->persist($devEASports);

        // Nintendo EPD
        $devNintendoEPD = new Developpeur();
        $devNintendoEPD->setNom('Nintendo EPD');
        $devNintendoEPD->setPays('Japon');
        $devNintendoEPD->setSiteWeb('https://nintendo.com');
        $devNintendoEPD->setDescription('Équipe de développement interne de Nintendo');
        $manager->persist($devNintendoEPD);

        // Valve
        $devValve = new Developpeur();
        $devValve->setNom('Valve');
        $devValve->setPays('États-Unis');
        $devValve->setSiteWeb('https://valvesoftware.com');
        $devValve->setDescription('Studio américain créateur de Half-Life, Portal et Steam');
        $manager->persist($devValve);

        // ========== JEUX VIDÉO AVEC DESCRIPTION ET IMAGE ==========

// Action
        $jeuVideo1 = new JeuVideo();
        $jeuVideo1->setTitre('The Last of Us Part II');
        $jeuVideo1->setEditeur($editeurSony);
        $jeuVideo1->setDeveloppeur($devNaughtyDog);
        $jeuVideo1->setGenre($genreAction);
        $jeuVideo1->setDateSortie(new \DateTime('2020-06-19'));
        $jeuVideo1->setPrix(59.99);
        $jeuVideo1->setDescription("Cinq ans après leur périlleux voyage, Ellie et Joel se sont installés à Jackson. Un événement violent vient perturber la paix précaire.");
        $jeuVideo1->setImageUrl('https://example.com/images/tlu2_cover.png');
        $manager->persist($jeuVideo1);

// RPG
        $jeuVideo2 = new JeuVideo();
        $jeuVideo2->setTitre('The Witcher 3: Wild Hunt');
        $jeuVideo2->setEditeur($editeurUbisoft);
        $jeuVideo2->setDeveloppeur($devCDPR);
        $jeuVideo2->setGenre($genreRPG);
        $jeuVideo2->setDateSortie(new \DateTime('2015-05-19'));
        $jeuVideo2->setPrix(39.99);
        $jeuVideo2->setDescription("Incarnez Geralt de Riv, un tueur de monstres professionnel, et partez à la recherche de Ciri, l'enfant de la prophétie, dans un monde ouvert tentaculaire.");
        $jeuVideo2->setImageUrl('https://example.com/images/witcher3_cover.png');
        $manager->persist($jeuVideo2);

// Stratégie
        $jeuVideo3 = new JeuVideo();
        $jeuVideo3->setTitre('Age of Empires IV');
        $jeuVideo3->setEditeur($editeurMicrosoft);
        $jeuVideo3->setDeveloppeur($devRelic);
        $jeuVideo3->setGenre($genreStrategie);
        $jeuVideo3->setDateSortie(new \DateTime('2021-10-28'));
        $jeuVideo3->setPrix(49.99);
        $jeuVideo3->setDescription("Le jeu de stratégie en temps réel légendaire fait son retour en vous mettant au centre d'épiques batailles historiques qui ont façonné le monde.");
        $jeuVideo3->setImageUrl('https://example.com/images/aoe4_cover.png');
        $manager->persist($jeuVideo3);

// Simulation
        $jeuVideo4 = new JeuVideo();
        $jeuVideo4->setTitre('Microsoft Flight Simulator');
        $jeuVideo4->setEditeur($editeurMicrosoft);
        $jeuVideo4->setDeveloppeur($devAsobo);
        $jeuVideo4->setGenre($genreSimulation);
        $jeuVideo4->setDateSortie(new \DateTime('2020-08-18'));
        $jeuVideo4->setPrix(69.99);
        $jeuVideo4->setDescription("Volez aux quatre coins du globe, des avions légers aux gros porteurs, avec un niveau de détail incroyable dans un monde modélisé par satellite.");
        $jeuVideo4->setImageUrl('https://example.com/images/mfs_cover.png');
        $manager->persist($jeuVideo4);

// Sport
        $jeuVideo5 = new JeuVideo();
        $jeuVideo5->setTitre('FIFA 24');
        $jeuVideo5->setEditeur($editeurEA);
        $jeuVideo5->setDeveloppeur($devEASports);
        $jeuVideo5->setGenre($genreSport);
        $jeuVideo5->setDateSortie(new \DateTime('2023-09-29'));
        $jeuVideo5->setPrix(69.99);
        $jeuVideo5->setDescription("Le jeu de football le plus réaliste du marché. Construisez votre équipe de rêve et affrontez le monde entier.");
        $jeuVideo5->setImageUrl('https://example.com/images/fifa24_cover.png');
        $manager->persist($jeuVideo5);

// Course
        $jeuVideo6 = new JeuVideo();
        $jeuVideo6->setTitre('Mario Kart 8 Deluxe');
        $jeuVideo6->setEditeur($editeurNintendo);
        $jeuVideo6->setDeveloppeur($devNintendoEPD);
        $jeuVideo6->setGenre($genreCourse);
        $jeuVideo6->setDateSortie(new \DateTime('2017-04-28'));
        $jeuVideo6->setPrix(59.99);
        $jeuVideo6->setDescription("L'expérience de course ultime avec tous les personnages et circuits de l'univers Mario. Batailles fun garanties.");
        $jeuVideo6->setImageUrl('https://example.com/images/mk8_cover.png');
        $manager->persist($jeuVideo6);

// Réflexion
        $jeuVideo7 = new JeuVideo();
        $jeuVideo7->setTitre('Portal 2');
        $jeuVideo7->setEditeur($editeurEA);
        $jeuVideo7->setDeveloppeur($devValve);
        $jeuVideo7->setGenre($genreReflexion);
        $jeuVideo7->setDateSortie(new \DateTime('2011-04-19'));
        $jeuVideo7->setPrix(19.99);
        $jeuVideo7->setDescription("Un jeu de réflexion à la première personne incroyablement drôle où vous utilisez un pistolet pour créer des portails.");
        $jeuVideo7->setImageUrl('https://example.com/images/portal2_cover.png');
        $manager->persist($jeuVideo7);

        // Action-Aventure
        $jeuVideo8 = new JeuVideo();
        $jeuVideo8->setTitre('The Legend of Zelda: Breath of the Wild');
        $jeuVideo8->setEditeur($editeurNintendo);
        $jeuVideo8->setDeveloppeur($devNintendoEPD);
        $jeuVideo8->setGenre($genreActionAventure);
        $jeuVideo8->setDateSortie(new \DateTime('2017-03-03'));
        $jeuVideo8->setPrix(59.99);
        $jeuVideo8->setDescription("Explorez le vaste royaume d'Hyrule comme jamais auparavant. Un monde ouvert où vous décidez de l'aventure.");
        $jeuVideo8->setImageUrl('https://example.com/images/botw_cover.png');
        $manager->persist($jeuVideo8);


        // --- Utilisateur 1: Alice Dubois ---
        $user1 = new Utilisateur();
        $user1->setPrenom('Alice');
        $user1->setNom('Dubois');
        $user1->setPseudo('AliceD');
        $user1->setMail('alice.dubois@example.com');
        $user1->setCreatedAt(new \DateTimeImmutable());
        $user1->setDateNaissance(new \DateTime('1990-05-15'));
        // $user1->setImageProfil('alice.jpg'); // Optionnel
        $manager->persist($user1);
        $this->addReference('user-alice', $user1);


        // --- Utilisateur 2: Benoît Lefevre ---
        $user2 = new Utilisateur();
        $user2->setPrenom('Benoît');
        $user2->setNom('Lefevre');
        $user2->setPseudo('BenoitL');
        $user2->setMail('benoit.lefevre@example.com');
        $user2->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($user2);
        $this->addReference('user-benoit', $user2);


        // --- Utilisateur 3: Clara Martin (avec mise à jour) ---
        $user3 = new Utilisateur();
        $user3->setPrenom('Clara');
        $user3->setNom('Martin');
        $user3->setPseudo('ClaraM');
        $user3->setMail('clara.martin@example.com');
        $user3->setCreatedAt(new \DateTimeImmutable());
        $user3->setUpdatedAt(new \DateTimeImmutable());
        $user3->setDateNaissance(new \DateTime('2001-11-03'));
        $manager->persist($user3);
        $this->addReference('user-clara', $user3);


        // --- Utilisateur 4: David Moreau (sans date de naissance) ---
        $user4 = new Utilisateur();
        $user4->setPrenom('David');
        $user4->setNom('Moreau');
        $user4->setPseudo('DMoreau');
        $user4->setMail('david.moreau@example.com');
        $user4->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($user4);
        $this->addReference('user-david', $user4);

        $collect1 = new Collect();
        $collect1->setUtilisateur($user4);
        $collect1->setJeuvideo($jeuVideo2);
        $collect1->setStatut(StatutJeuEnum::POSSEDE);
        $collect1->setDateModifStatut(new \DateTimeImmutable());
        $collect1->setPrixAchat(59.99);
        $collect1->setDateAchat(new \DateTime('2021-03-10'));
        $collect1->setCommentaire("Acheté en solde, toujours relaxant pour des vols longs.");
        $collect1->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($collect1);

        // Alice souhaite FFXVI
        $collect2 = new Collect();
        $collect2->setUtilisateur($user3);
        $collect2->setJeuvideo($jeuVideo1);
        $collect2->setPrixAchat(39.99);
        $collect2->setDateAchat(new \DateTime('2021-03-10'));
        $collect2->setCommentaire("Jeu très prenant, mais je n'ai pas beaucoup de temps.");
        $collect2->setStatut(StatutJeuEnum::SOUHAITE);
        $collect2->setDateModifStatut(new \DateTimeImmutable());
        $collect2->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($collect2);

        // --- 2. Benoît : En cours sur FFXVI ---

        $collect3 = new Collect();
        $collect3->setUtilisateur($user2);
        $collect3->setJeuvideo($jeuVideo2);
        $collect3->setPrixAchat(29.99);
        $collect3->setDateAchat(new \DateTime('2021-03-10'));
        $collect3->setStatut(StatutJeuEnum::EN_COURS);
        $collect3->setDateModifStatut(new \DateTimeImmutable());
        $collect3->setCommentaire("Jeu très prenant, mais je n'ai pas beaucoup de temps.");
        $collect3->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($collect3);

        // --- 3. Clara : Terminé MFS ---

        $collect4 = new Collect();
        $collect4->setUtilisateur($user1);
        $collect4->setJeuvideo($jeuVideo6);
        $collect4->setPrixAchat(2.99);
        $collect4->setDateAchat(new \DateTime('2021-03-10'));
        $collect4->setStatut(StatutJeuEnum::TERMINE);
        $collect4->setDateModifStatut(new \DateTimeImmutable());
        $collect4->setCommentaire("Très belle expérience, j'ai débloqué tous les aéroports.");
        $collect4->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($collect4);

        // --- 4. David : Souhaite MFS ---

        $collect5 = new Collect();
        $collect5->setUtilisateur($user4);
        $collect5->setJeuvideo($jeuVideo4);
        $collect5->setPrixAchat(79.99);
        $collect5->setDateAchat(new \DateTime('2021-03-10'));
        $collect5->setCommentaire("Jeu très prenant, mais je n'ai pas beaucoup de temps.");
        $collect5->setStatut(StatutJeuEnum::SOUHAITE);
        $collect5->setDateModifStatut(new \DateTimeImmutable());
        $collect5->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($collect5);

        $manager->flush();
    }

}
