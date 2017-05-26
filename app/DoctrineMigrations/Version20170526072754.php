<?php

namespace Application\Migrations;

use AppBundle\Entity\Image;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170526072754 extends AbstractMigration implements ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs

    }

    /**
     * @param Schema $schema
     */
    public function postUp(Schema $schema)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');

        $images = [
            'http://karklenusodyba.lt/wp-content/uploads/2014/11/Karklenu-sodyba3.jpg',
            'http://www.apievestuves.lt/g/originals/50/Karvio%20dvaras%20sodybos%20vestuvems.7.jpg',
            'http://www.plotai.lt/media/objects/550x356/sodyba-ivio.jpg?1443450435',
            'http://www.atostogoskaime.lt/uploads/Sodybos/images/galleries/1504/zoomfan/picture-018.jpg'
            ];

        $i=0;

        foreach ($images as $image) {
            $i++;
            $newImage = new Image();
            $name = 'foto' . $i;

            $newImage->setUrl($image);
            $newImage->setName($name);


            $em->persist($newImage);
        }

        $em->flush();
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
