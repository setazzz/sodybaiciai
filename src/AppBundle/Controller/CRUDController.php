<?php

namespace AppBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CRUDController extends Controller
{
    public function confirmAction($id)
    {
        $bookingRequest = $this->admin->getSubject();
        $booker = $this->get('booker');

        if (!$bookingRequest) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if ($booker->isAvailableForPeriod($bookingRequest->getItem(), $bookingRequest->getStart(), $bookingRequest->getEnd())) {
           if ($booker->book($bookingRequest->getItem(), $bookingRequest->getStart(), $bookingRequest->getEnd())){
               $this->addFlash('sonata_flash_success', 'Rezervuota sėkmingai');
           }
        }
        else {
//            throw new NotFoundHttpException(sprintf('unable to find date'));
            $this->addFlash('sonata_flash_warning', 'Data jau užimta');

        }


        return new RedirectResponse($this->admin->generateUrl('list'));
    }


    public function editAction($id = null)
    {
        $bookingRequest = $this->admin->getSubject();
        $user = $bookingRequest->getUser();

        $provider = $this->get('fos_message.provider');

        $threads = $provider->getInboxThreads();
        $conversation = $provider->getThread($bookingRequest->getThread());

        $replyForm = $this->container->get('fos_message.reply_form.factory')->create($conversation);
        $formHandler = $this->container->get('fos_message.reply_form.handler');

        if ($message = $formHandler->process($replyForm)) {
//            return new RedirectResponse($this->container->get('router')->generate('fos_message_thread_view', array(
//                'threadId' => $message->getThread()->getId(),
//            )));
        }



        $request = $this->getRequest();
        // the key used to lookup the template
        $templateKey = 'edit';

        $id = $request->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);

        if (!$object) {
            throw $this->createNotFoundException(sprintf('unable to find the object with id : %s', $id));
        }

        $this->admin->checkAccess('edit', $object);

        $preResponse = $this->preEdit($request, $object);
        if ($preResponse !== null) {
            return $preResponse;
        }

        $this->admin->setSubject($object);

        /** @var $form Form */
        $form = $this->admin->getForm();
        $form->setData($object);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            //TODO: remove this check for 4.0
            if (method_exists($this->admin, 'preValidate')) {
                $this->admin->preValidate($object);
            }
            $isFormValid = $form->isValid();

            // persist if the form was valid and if in preview mode the preview was approved
            if ($isFormValid && (!$this->isInPreviewMode() || $this->isPreviewApproved())) {
                try {
                    $object = $this->admin->update($object);

                    if ($this->isXmlHttpRequest()) {
                        return $this->renderJson(array(
                            'result' => 'ok',
                            'objectId' => $this->admin->getNormalizedIdentifier($object),
                            'objectName' => $this->escapeHtml($this->admin->toString($object)),
                        ), 200, array());
                    }

                    $this->addFlash(
                        'sonata_flash_success',
                        $this->trans(
                            'flash_edit_success',
                            array('%name%' => $this->escapeHtml($this->admin->toString($object))),
                            'SonataAdminBundle'
                        )
                    );

                    // redirect to edit mode
                    return $this->redirectTo($object);
                } catch (ModelManagerException $e) {
                    $this->handleModelManagerException($e);

                    $isFormValid = false;
                } catch (LockException $e) {
                    $this->addFlash('sonata_flash_error', $this->trans('flash_lock_error', array(
                        '%name%' => $this->escapeHtml($this->admin->toString($object)),
                        '%link_start%' => '<a href="'.$this->admin->generateObjectUrl('edit', $object).'">',
                        '%link_end%' => '</a>',
                    ), 'SonataAdminBundle'));
                }
            }

            // show an error message if the form failed validation
            if (!$isFormValid) {
                if (!$this->isXmlHttpRequest()) {
                    $this->addFlash(
                        'sonata_flash_error',
                        $this->trans(
                            'flash_edit_error',
                            array('%name%' => $this->escapeHtml($this->admin->toString($object))),
                            'SonataAdminBundle'
                        )
                    );
                }
            } elseif ($this->isPreviewRequested()) {
                // enable the preview template if the form was valid and preview was requested
                $templateKey = 'preview';
                $this->admin->getShow();
            }
        }

        $formView = $form->createView();
        $replyForm = $replyForm->createView();

        // set the theme for the current Admin Form
//        $this->setFormTheme($formView, $this->admin->getFormTheme());

        return $this->render($this->admin->getTemplate($templateKey), array(
            'action' => 'edit',
            'form' => $formView,
            'replyForm' => $replyForm,
            'object' => $object,
            'thread' => $conversation,
        ), null);
    }
}