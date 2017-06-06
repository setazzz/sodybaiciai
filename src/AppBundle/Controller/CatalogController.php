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
/**
 * @Route("/catalog", name="catalogIndex")
 */
class CatalogController extends Controller
{
    /**
     * @Route("/", name="catalog")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $list = $em->getRepository('AppBundle:Sodyba')->findAll();
        $categories = $em->getRepository('AppBundle:Category')->findAll();

        return $this->render('catalog/index.html.twig', [
            'list' => $list,
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/category/{id}", name="category_catalog")
     */
    public function categoryAction(Request $request, int $id)
    {
        $em = $this->getDoctrine()->getManager();

        $list = $em->getRepository('AppBundle:Sodyba')->findBy(['category' => $id]);
        $categories = $em->getRepository('AppBundle:Category')->findAll();

        return $this->render('catalog/index.html.twig', [
            'list' => $list,
            'categories' => $categories,
        ]);
    }
}
