<?php
/**
 * Created by PhpStorm.
 * User: Matas
 * Date: 2017.05.25
 * Time: 11:57
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DetailsController extends Controller
{
    /**
     * @Route("/details/{id}", name="details")
     */
    public function indexAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $sodyba = $this->getDoctrine()->getRepository('AppBundle:Sodyba')->find($id);

        // replace this example code with whatever you need
        return $this->render('details/details.html.twig', [
            'sodyba' => $sodyba,
        ]);
    }
}
