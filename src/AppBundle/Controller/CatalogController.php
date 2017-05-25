<?php
/**
 * Created by PhpStorm.
 * User: Matas
 * Date: 2017.05.25
 * Time: 11:21
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CatalogController extends Controller
{
    /**
     * @Route("/catalog", name="catalog")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $list = $this->getDoctrine()->getRepository('AppBundle:Sodyba')->findAll();


        // replace this example code with whatever you need
        return $this->render('catalog/index.html.twig', [
            'list' => $list,
        ]);
    }
}
