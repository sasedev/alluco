<?php

namespace Alluco\SecurityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Form Class used to initialize password recovery process
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class LostPasswordTForm extends AbstractType
{

    /**
     * BuildForm
     * (non-PHPdoc) @see \Symfony\Component\Form\AbstractType::buildForm()
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text', array('label' => 'profile.username.label', 'mapped' => false));

        $builder->add('captcha', 'captcha', array('label' => 'profile.captcha.label', 'width' => 250,
            'height' => 60,
            'length' => 6,
            'quality' => 100,
            'as_file' => true
        ));

        $builder->add('submit', 'submit', array('label' => 'action.btnSend'));
    }

    /**
     * (non-PHPdoc) @see \Symfony\Component\Form\FormTypeInterface::getName()
     *
     * @return string
     */
    public function getName()
    {
        return 'LostPasswordForm';
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
