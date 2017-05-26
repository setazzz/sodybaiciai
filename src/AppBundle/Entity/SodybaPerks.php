<?php
/**
 * Created by PhpStorm.
 * User: Matas
 * Date: 2017.05.25
 * Time: 16:53
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlogPost
 *
 * @ORM\Table(name="sodyba_perks")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SodybaPerksRepository")
 */
class SodybaPerks
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Sodyba", inversedBy="blogPosts")
     */
    private $sodyba;

    /**
     * @ORM\ManyToOne(targetEntity="Perks", inversedBy="blogPosts")
     */
    private $perks;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}