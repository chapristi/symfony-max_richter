<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Migration initiale avec les champs created_at et updated_at sur jeu_video
 */
final class Version20251014170240 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Création des tables editeur, genre et jeu_video avec created_at et updated_at sur jeu_video';
    }

    public function up(Schema $schema): void
    {
        // Table éditeur
        $this->addSql('
            CREATE TABLE editeur (
                id INT AUTO_INCREMENT NOT NULL,
                nom VARCHAR(255) NOT NULL,
                pays VARCHAR(100) DEFAULT NULL,
                site_web VARCHAR(255) DEFAULT NULL,
                description LONGTEXT DEFAULT NULL,
                created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\',
                updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\',
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        ');

        // Table genre
        $this->addSql('
            CREATE TABLE genre (
                id INT AUTO_INCREMENT NOT NULL,
                nom VARCHAR(100) DEFAULT NULL,
                description LONGTEXT DEFAULT NULL,
                actif TINYINT(1) NOT NULL,
                created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\',
                updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\',
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        ');

        // Table jeu_video avec created_at et updated_at inclus
        $this->addSql('
            CREATE TABLE jeu_video (
                id INT AUTO_INCREMENT NOT NULL,
                editeur_id INT NOT NULL,
                genre_id INT NOT NULL,
                titre VARCHAR(255) NOT NULL,
                developpeur VARCHAR(255) NOT NULL,
                date_sortie DATE DEFAULT NULL,
                prix NUMERIC(6, 2) DEFAULT NULL,
                description LONGTEXT DEFAULT NULL,
                image_url VARCHAR(255) DEFAULT NULL,
                created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\',
                updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\',
                INDEX IDX_4E22D9D43375BD21 (editeur_id),
                INDEX IDX_4E22D9D44296D31F (genre_id),
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        ');

        // Contraintes de clés étrangères
        $this->addSql('ALTER TABLE jeu_video ADD CONSTRAINT FK_4E22D9D43375BD21 FOREIGN KEY (editeur_id) REFERENCES editeur (id)');
        $this->addSql('ALTER TABLE jeu_video ADD CONSTRAINT FK_4E22D9D44296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
    }

    public function down(Schema $schema): void
    {
        // Suppression dans le bon ordre
        $this->addSql('ALTER TABLE jeu_video DROP FOREIGN KEY FK_4E22D9D43375BD21');
        $this->addSql('ALTER TABLE jeu_video DROP FOREIGN KEY FK_4E22D9D44296D31F');
        $this->addSql('DROP TABLE jeu_video');
        $this->addSql('DROP TABLE editeur');
        $this->addSql('DROP TABLE genre');
    }
}
