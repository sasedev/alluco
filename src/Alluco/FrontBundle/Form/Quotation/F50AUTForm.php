<?php

namespace Alluco\FrontBundle\Form\Quotation;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\GreaterThan;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class F50AUTForm extends AbstractType
{

    /**
     * Form builder
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('height', 'integer', array('label' => 'Quotation.height.label', 'required' => true, 'data' => 0, 'constraints' => array(new GreaterThan(array('value' => 0)))));

        $builder->add('widthL', 'integer', array('label' => 'Quotation.widthL.label', 'required' => true, 'data' => 0, 'constraints' => array(new GreaterThan(array('value' => 0)))));

        $builder->add('widthC', 'integer', array('label' => 'Quotation.widthC.label', 'required' => true, 'data' => 0, 'constraints' => array(new GreaterThan(array('value' => 0)))));

        $builder->add('widthR', 'integer', array('label' => 'Quotation.widthR.label', 'required' => true, 'data' => 0, 'constraints' => array(new GreaterThan(array('value' => 0)))));

        $builder->add('prof', 'integer', array('label' => 'Quotation.prof.label', 'required' => true, 'data' => 0, 'constraints' => array(new GreaterThan(array('value' => 0)))));

        $builder->add('submit', 'submit', array('label' => 'action.btnValidate', 'attr' => array('class'=> 'btn-primary btn')));
    }

    /**
     * (non-PHPdoc) @see \Symfony\Component\Form\FormTypeInterface::getName()
     */
    public function getName()
    {
        return "F50AUForm";
    }

    /**
     * get the default options
     *
     * @return multitype:string multitype:string
     */
    public function getDefaultOptions()
    {
        return array('validation_groups' => array('Default'));
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