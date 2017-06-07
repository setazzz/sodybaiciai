<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BookingRequest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
        $booker = $this->get('booker');
        $form = $this->createFormBuilder()
            ->add('duration', TextType::class, array('label' => 'Trukmė'))
            ->add('message', TextareaType::class, array('label' => 'Žinutė'))
            ->add('save', SubmitType::class, array('label' => 'Rezervuoti'))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
            $range = explode(" - ",$data['duration']);
            $start = new \DateTime($range[0]);
            $end = new \DateTime($range[1]);

            if ($booker->isAvailableForPeriod($id, $start, $end)) {

                $recipients = $em->getRepository('AppBundle:User')->findByRole("ROLE_SUPER_ADMIN");
                $threadBuilder = $this->get('fos_message.composer')->newThread();
                foreach ($recipients as $recipient) {
                    $threadBuilder->addRecipient($recipient);
                }
                $threadBuilder
                    ->setSender($this->get('security.token_storage')->getToken()->getUser())
                    ->setSubject($sodyba->getTitle())
                    ->setBody($data['message']);
                $sender = $this->get('fos_message.sender');
                $sender->send($threadBuilder->getMessage());

                $bookingRequest = new BookingRequest();
                $bookingRequest->setUser($this->get('security.token_storage')->getToken()->getUser());
                $bookingRequest->setStart($start);
                $bookingRequest->setEnd($end);
                $bookingRequest->setItem($sodyba);
                $bookingRequest->setThread($threadBuilder->getMessage()->getThread()->getId());

                $em->persist($bookingRequest);
                $em->flush();

                $this->addFlash(
                    'notice',
                    'Your form was saved!'
                );
            } else {
                $this->addFlash(
                    'notice',
                    'Error!'
                );
            }

            return $this->redirectToRoute('myaccount');
        }

        return $this->render('details/details.html.twig', [
            'sodyba' => $sodyba,
            'form' => $form->createView(),
        ]);
    }
}
