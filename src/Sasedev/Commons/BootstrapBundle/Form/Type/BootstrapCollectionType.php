<?php

namespace Sasedev\Commons\BootstrapBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class BootstrapCollectionType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars = array_replace(
            $view->vars,
            array(
                'allow_add' => $options['allow_add'],
                'allow_delete' => $options['allow_delete'],
                'add_button_text' => $options['add_button_text'],
                'delete_button_text' => $options['delete_button_text'],
                'sub_widget_col' => $options['sub_widget_col'],
                'button_col' => $options['button_col'],
                'prototype_name' => $options['prototype_name'],
                'add_icon' => $options['add_icon'],
                'delete_icon' => $options['delete_icon']
            )
        );

        if (false === $view->vars['allow_delete']) {
            $view->vars['sub_widget_col'] += $view->vars['button_col'];
        }

        if ($form->getConfig()
            ->hasAttribute('prototype')) {
            $view->vars['prototype'] = $form->getConfig()
                ->getAttribute('prototype')
                ->createView($view);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $optionsNormalizer = function (Options $options, $value) {
            // @codeCoverageIgnoreStart
            $value['block_name'] = 'entry';

            return $value;
            // @codeCoverageIgnoreEnd
        };

        $resolver->setDefaults(
            array(
                'allow_add' => false,
                'allow_delete' => false,
                'prototype' => true,
                'prototype_name' => '__name__',
                'type' => 'text',
                'add_button_text' => 'Add',
                'add_icon' => 'plus',
                'delete_button_text' => 'Delete',
                'delete_icon' => 'trash',
                'sub_widget_col' => 9,
                'button_col' => 3,
                'options' => array()
            )
        );

        $resolver->setNormalizers(array('options' => $optionsNormalizer));
    }

    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return 'collection';
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'bootstrap_collection';
    }
}
