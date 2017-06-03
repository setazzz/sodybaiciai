<?php
/**
 * Created by PhpStorm.
 * User: Matas
 * Date: 2017.05.25
 * Time: 11:57
 */

namespace AppBundle\Controller;

use AppBundle\Entity\BookingRequest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
//use Sonata\AdminBundle\Form\Type\Filter\DateType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class DetailsController extends Controller
{
    /**
     * @Route("/details/{id}", name="details")
     */
    public function indexAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $sodyba = $this->getDoctrine()->getRepository('AppBundle:Sodyba')->find($id);
        $booker = $this->get('booker');
//        $start = new DateTime("2017-06-02");
//        $end = new DateTime("2017-06-03");

//        dump($booker->book($sodyba, $start, $end));
        $form = $this->createFormBuilder()
            ->add('duration', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Rezervuoti'))
            ->getForm();
        return $this->render('details/details.html.twig', [
            'sodyba' => $sodyba,
            'form' => $form->createView(),
        ]);
    }
}
