<?php

/**
 * Created by PhpStorm.
 * User: Matas
 * Date: 2017.06.05
 * Time: 14:21
 */

namespace UserBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;

class RegistrationController extends BaseController
{
    /**
     * Tell the user his account is now confirmed.
     */
    public function confirmedAction()
    {
        return $this->render('default/index.html.twig');
    }
}