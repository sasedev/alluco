<?php

namespace Sasedev\Commons\TwigBundle\Extension;

use Twig_Extension;
use Twig_Filter_Method;
use Twig_Function_Method;

/**
 * IonIcon helper
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 *
 */
class IonIconExtension extends Twig_Extension
{

    /**
     * {@inheritDoc}
     */
    public function getFilters()
    {
        return array(
            'parse_icons' => new Twig_Filter_Method(
                $this,
                'parseIconsFilter',
                array('pre_escape' => 'html', 'is_safe' => array('html'))
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            'ionIco' => new Twig_Function_Method(
                $this,
                'iconFunction',
                array('pre_escape' => 'html', 'is_safe' => array('html'))
            )
        );
    }

    /**
     * Parses the given string and replaces all occurrences of .icon-[name] with the corresponding icon.
     *
     * @param string $text  The text to parse
     *
     * @return string The HTML code with the icons
     */
    public function parseIconsFilter($text)
    {
        $that = $this;
        return preg_replace_callback(
            '/\.ionIco-([a-z0-9-]+)/',
            function ($matches) use ($that) {
                return $that->iconFunction($matches[1]);
            },
            $text
        );
    }

    /**
     * Returns the HTML code for the given icon.
     *
     * @param string $icon  The name of the icon
     *
     * @return string The HTML code for the icon
     */
    public function iconFunction($ionIcon)
    {
        return sprintf('<span class="ion ion-%s"></span>', $ionIcon);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'Sasedev.Commons.Twig.IonIcon';
    }
}
