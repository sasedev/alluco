<?php

namespace Alluco\AdminBundle\Form\Product;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class UpdateRankTForm extends AbstractType
{
    /**
     * Form builder
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('rank', 'integer', array('label' => 'Product.rank.label'));

    }

    /**
     * (non-PHPdoc) @see \Symfony\Component\Form\FormTypeInterface::getName()
     *
     * @return string
     */
    public function getName()
    {

        return 'ProductUpdateRankForm';

    }

    /**
     * get the default options
     *
     * @return multitype:string multitype:string
     */
    public function getDefaultOptions()
    {

        return array('validation_groups' => array('rank'));

    }

    /**
     * (non-PHPdoc) @see
     * \Symfony\Component\Form\AbstractType::setDefaultOptions()
     *
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {

        $resolver->setDefaults($this->getDefaultOptions());

    }
}
