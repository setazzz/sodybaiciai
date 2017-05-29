<?php
/**
 * Created by PhpStorm.
 * User: Matas
 * Date: 2017.05.29
 * Time: 11:34
 */

namespace MessageBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MessageBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSMessageBundle';
    }
}