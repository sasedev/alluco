<?php

namespace Alluco\AdminBundle\Form\ProductTrans;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Image;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class UpdateThumbInfoTForm extends AbstractType
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

        $builder->add('thumbAlt', 'text', array('label' => 'ProductTrans.thumbAlt.label'));

        $builder->add('thumbTitle', 'text', array('label' => 'ProductTrans.thumbTitle.label', 'required' => false));

    }

    /**
     * (non-PHPdoc) @see \Symfony\Component\Form\FormTypeInterface::getName()
     *
     * @return string
     */
    public function getName()
    {

        return 'ProductTransUpdateThumbInfoForm_'.$this->formName;

    }

    /**
     * get the default options
     *
     * @return multitype:string multitype:string
     */
    public function getDefaultOptions()
    {

        return array('validation_groups' => array('thumbAlt', 'thumbTitle'));

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
