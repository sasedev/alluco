<?php

namespace Alluco\AdminBundle\Form\Staticpage;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class UpdateTForm extends AbstractType
{
    /**
     * Form builder
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('metaTitle', 'text', array('label' => 'Staticpage.metaTitle.label'));

        $builder->add('metaKeywords', 'text', array('label' => 'Staticpage.metaKeywords.label', 'required' => false));

        $builder->add('metaDescription', 'text', array('label' => 'Staticpage.metaDescription.label', 'required' => false));

        $builder->add('pageTitle', 'text', array('label' => 'Staticpage.pageTitle.label'));

        $builder->add('breadcrumb', 'text', array('label' => 'Staticpage.breadcrumb.label'));

        $builder->add('pageContent', 'textarea', array('label' => 'Staticpage.pageContent.label', 'required' => false));

    }

    /**
     * (non-PHPdoc) @see \Symfony\Component\Form\FormTypeInterface::getName()
     *
     * @return string
     */
    public function getName()
    {

        return 'StaticpageUpdateForm';

    }

    /**
     * get the default options
     *
     * @return multitype:string multitype:string
     */
    public function getDefaultOptions()
    {

        return array('validation_groups' => array('metaTitle', 'pageTitle', 'breadcrumb'));

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
