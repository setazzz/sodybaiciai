<?php

namespace Application\Migrations;

use AppBundle\Entity\Category;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\Sodyba;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170523115654 extends AbstractMigration implements ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema){
    }

    /**
     * @param Schema $schema
     */
    public function postUp(Schema $schema)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');

        $categories = $em->getRepository(Category::class)->findAll();
        $category = $categories[0];

        $sodyba = new Sodyba();
        $sodyba->setTitle('Sodyba Aukštadvaryje');
        $sodyba->setBody('Sodyba ant ežero kranto');
        $sodyba->setCategory($category);
        $em->persist($sodyba);

        $sodyba = new Sodyba();
        $sodyba->setTitle('Sodyba Trakuose');
        $sodyba->setBody('Sodyba ant ežero kranto su pirtimi');
        $sodyba->setCategory($category);
        $em->persist($sodyba);

        $category = $categories[1];

        $sodyba = new Sodyba();
        $sodyba->setTitle('Sodyba Labanoro girioje');
        $sodyba->setBody('Sodyba visuryje miško');
        $sodyba->setCategory($category);
        $em->persist($sodyba);

        $sodyba = new Sodyba();
        $sodyba->setTitle('Sodyba prie Neries');
        $sodyba->setBody('Sodyba ant upės kranto');
        $sodyba->setCategory($category);
        $em->persist($sodyba);


        $em->flush();
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema){
    }
}
