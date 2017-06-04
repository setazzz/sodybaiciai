<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/myaccount", name="myaccount")
     */
    public function accountAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $currentUser = $this->get('security.token_storage')->getToken()->getUser()->getUsername();
        $requests = $this->getDoctrine()->getRepository('AppBundle:BookingRequest')->findBy(['user' => $currentUser]);
        $reservations = $this->getDoctrine()->getRepository('AppBundle:Booking')->findAll();

        return $this->render('account/req_list.html.twig', [
            'requests' => $requests,
        ]);
    }

    /**
     * @Route("/thread/{id}", name="thread")
     */
    public function threadAction(Request $request, $id)
    {

        $provider = $this->get('fos_message.provider');
        $thread = $provider->getThread($id);
        $replyForm = $this->get('fos_message.reply_form.factory')->create($thread);
        $formHandler = $this->get('fos_message.reply_form.handler');

        if ($message = $formHandler->process($replyForm)) {
            return new RedirectResponse($this->get('router')->generate('thread', array(
                'id' => $message->getThread()->getId(),
            )));
        }

        $replyForm = $replyForm->createView();

        return $this->render('account/thread.html.twig', [
            'thread' => $thread,
            'form' =>$replyForm,
        ]);
    }
}
