<?php

namespace Alluco\AdminBundle\Form\BannerTrans;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class UpdateInfoTForm extends AbstractType
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

        $builder->add('alt', 'text', array('label' => 'BannerTrans.alt.label'));

        $builder->add('title', 'text', array('label' => 'BannerTrans.title.label', 'required' => false));

    }

    /**
     * (non-PHPdoc) @see \Symfony\Component\Form\FormTypeInterface::getName()
     *
     * @return string
     */
    public function getName()
    {

        return 'BannerTransUpdateInfoForm_'.$this->formName;

    }

    /**
     * get the default options
     *
     * @return multitype:string multitype:string
     */
    public function getDefaultOptions()
    {

        return array('validation_groups' => array('alt', 'title'));

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
