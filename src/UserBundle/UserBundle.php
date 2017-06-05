<?php
/**
 * Created by PhpStorm.
 * User: Matas
 * Date: 2017.06.05
 * Time: 14:15
 */

namespace UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class UserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}