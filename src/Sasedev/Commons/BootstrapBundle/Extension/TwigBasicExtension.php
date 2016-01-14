<?php
namespace Sasedev\Commons\BootstrapBundle\Extension;

use Twig_Extension;
use Twig_Function_Method;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class TwigBasicExtension extends Twig_Extension
{
    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        $options = array('pre_escape' => 'html', 'is_safe' => array('html'));

        return array(
            'bsLabel'           => new Twig_Function_Method($this, 'labelFunction', $options),
            'bsLabelPrimary'    => new Twig_Function_Method($this, 'labelPrimaryFunction', $options),
            'bsLabelSuccess'    => new Twig_Function_Method($this, 'labelSuccessFunction', $options),
            'bsLabelInfo'       => new Twig_Function_Method($this, 'labelInfoFunction', $options),
            'bsLabelWarning'    => new Twig_Function_Method($this, 'labelWarningFunction', $options),
            'bsLabelDanger'     => new Twig_Function_Method($this, 'labelDangerFunction', $options),
            'bsBadge'           => new Twig_Function_Method($this, 'badgeFunction', $options)
        );
    }

    /**
     * Returns the HTML code for a label.
     *
     * @param string $text The text of the label
     * @param string $type The type of label
     *
     * @return string The HTML code of the label
     */
    public function labelFunction($text, $type = 'default')
    {
        return sprintf('<span class="label%s">%s</span>', ($type ? ' label-' . $type : ''), $text);
    }

    /**
     * @param string $text
     *
     * @return string
     */
    public function labelPrimaryFunction($text)
    {
        return $this->labelFunction($text, 'primary');
    }

    /**
     * Returns the HTML code for a success label.
     *
     * @param string $text The text of the label
     *
     * @return string The HTML code of the label
     */
    public function labelSuccessFunction($text)
    {
        return $this->labelFunction($text, 'success');
    }

    /**
     * Returns the HTML code for a warning label.
     *
     * @param string $text The text of the label
     *
     * @return string The HTML code of the label
     */
    public function labelWarningFunction($text)
    {
        return $this->labelFunction($text, 'warning');
    }

    /**
     * Returns the HTML code for a important label.
     *
     * @param string $text The text of the label
     *
     * @return string The HTML code of the label
     */
    public function labelDangerFunction($text)
    {
        return $this->labelFunction($text, 'danger');
    }

    /**
     * Returns the HTML code for a info label.
     *
     * @param string $text The text of the label
     *
     * @return string The HTML code of the label
     */
    public function labelInfoFunction($text)
    {
        return $this->labelFunction($text, 'info');
    }

    /**
     * Returns the HTML code for a badge.
     *
     * @param string $text The text of the badge
     *
     * @return string The HTML code of the badge
     */
    public function badgeFunction($text)
    {
        return sprintf('<span class="badge">%s</span>', $text);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'Sasedev.Commons.Bootstrap.Extension.TwigBasic';
    }
}
