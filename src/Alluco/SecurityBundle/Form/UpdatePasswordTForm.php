<?php

namespace Alluco\SecurityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class UpdatePasswordTForm extends AbstractType
{

    /**
     * Form builder
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('oldPassword', 'password', array('label' => 'profile.oldPassword.label', 'mapped' => false));

        $builder->add('clearPassword', 'repeated',
            array('type' => 'password', 'invalid_message' => 'profile.newPassword.repeat.notequal',
                'first_options' => array('label' => 'profile.newPassword.first',
                    'attr' => array('label_col' => 3, 'widget_col' => 5)),
                'second_options' => array('label' => 'profile.newPassword.second',
                    'attr' => array('label_col' => 3, 'widget_col' => 5))));
    }

    /**
     * (non-PHPdoc) @see \Symfony\Component\Form\FormTypeInterface::getName()
     *
     * @return string
     */
    public function getName()
    {
        return 'UserUpdatePasswordForm';
    }

    /**
     * get the default options
     *
     * @return multitype:string multitype:string
     */
    public function getDefaultOptions()
    {
        return array('validation_groups' => array('Default', 'password'));
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
