<?php

namespace Sasedev\Commons\BootstrapBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class TypeSetterExtension extends AbstractTypeExtension
{
    /**
     * {@inheritDoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['original_type'] = $form->getConfig()->getType()->getName();
    }

    /**
     * {@inheritDoc}
     */
    public function getExtendedType()
    {
        return "form";
    }
}
