<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260617153359 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add user_id to album and assign existing albums to admin';
    }

    public function up(Schema $schema): void
    {
        // 1) Ajouter la colonne user_id nullable
        $this->addSql('ALTER TABLE album ADD user_id INT DEFAULT NULL');

        // 2) Assigner un user existant aux albums déjà présents
        // On prend l’admin "ina@test.com"
        $this->addSql("
            UPDATE album 
            SET user_id = (SELECT id FROM user WHERE email = 'ina@test.com' LIMIT 1)
            WHERE user_id IS NULL
        ");

        // 3) Rendre la colonne NOT NULL
        $this->addSql('ALTER TABLE album MODIFY user_id INT NOT NULL');

        // 4) Ajouter la contrainte foreign key
        $this->addSql('ALTER TABLE album ADD CONSTRAINT FK_ALBUM_USER FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_ALBUM_USER ON album (user_id)');

        // 5) Nettoyage : supprimer l’ancien champ parasite dans user si encore présent
        $this->addSql('ALTER TABLE user DROP COLUMN user_id');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE album DROP FOREIGN KEY FK_ALBUM_USER');
        $this->addSql('DROP INDEX IDX_ALBUM_USER ON album');
        $this->addSql('ALTER TABLE album DROP COLUMN user_id');

        // Restaurer l’ancien champ parasite (inutile mais nécessaire pour down)
        $this->addSql('ALTER TABLE user ADD user_id INT DEFAULT NULL');
    }
}
