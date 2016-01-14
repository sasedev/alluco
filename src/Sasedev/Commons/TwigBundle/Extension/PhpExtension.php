<?php

namespace Sasedev\Commons\TwigBundle\Extension;

use Twig_Extension;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class PhpExtension extends Twig_Extension
{

    public function getFunctions()
    {

        $fonctions = array();

        $fonctions['CallPhp_*'] = new \Twig_Function_Method(
            $this,
            'twigToPhp',
            array('pre_escape' => 'html', 'is_safe' => array('html'))
        );

        return $fonctions;

    }

    public function twigToPhp()
    {

        $arg_list = func_get_args();
        $function = array_shift($arg_list);

        return call_user_func_array($function, $arg_list);

    }

    public function getName()
    {

        return 'Sasedev.Commons.Twig.CallPhp';

    }
}
