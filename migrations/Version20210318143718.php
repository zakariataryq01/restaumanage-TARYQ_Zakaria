<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210318143718 extends AbstractMigration
{
    private $entitymanager;
    public function __construct(Connection $connection,LoggerInterface $logger)
    {
        parent::__construct($connection,$logger);
    }

    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $querys = file('scripts/script.sql', FILE_IGNORE_NEW_LINES);
        foreach($querys as $query){$this->addSql($query);}
    }
    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
