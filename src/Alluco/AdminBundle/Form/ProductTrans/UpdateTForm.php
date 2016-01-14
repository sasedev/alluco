<?php

namespace Alluco\AdminBundle\Form\ProductTrans;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class UpdateTForm extends AbstractType
{

    private $formName;

    /**
     * Constructor
     *
     * @param string $filename
     */
    public function __construct($formName)
    {

        $this->formName = $formName;

    }

    /**
     * Form builder
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('metaTitle', 'text', array('label' => 'ProductTrans.metaTitle.label'));

        $builder->add('metaKeywords', 'text', array('label' => 'ProductTrans.metaKeywords.label', 'required' => false));

        $builder->add('metaDescription', 'text', array('label' => 'ProductTrans.metaDescription.label', 'required' => false));

        $builder->add('pageTitle', 'text', array('label' => 'ProductTrans.pageTitle.label'));

        $builder->add('breadcrumb', 'text', array('label' => 'ProductTrans.breadcrumb.label'));

        $builder->add('pageContent', 'textarea', array('label' => 'ProductTrans.pageContent.label'));

    }

    /**
     * (non-PHPdoc) @see \Symfony\Component\Form\FormTypeInterface::getName()
     *
     * @return string
     */
    public function getName()
    {

        return 'ProductTransUpdateForm_'.$this->formName;

    }

    /**
     * get the default options
     *
     * @return multitype:string multitype:string
     */
    public function getDefaultOptions()
    {

        return array('validation_groups' => array('metaTitle', 'pageTitle', 'breadcrumb', 'pageContent'));

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
