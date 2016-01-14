<?php

namespace Alluco\SecurityBundle\Form;

use Alluco\DataBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class UpdateProfileTForm extends AbstractType
{

    /**
     * Form builder
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('sexe', 'choice', array('label' => 'profile.sexe.label', 'choices' => User::choiceSexe()));

        $builder->add('firstName', 'text', array('label' => 'profile.firstName.label', 'required' => false));

        $builder->add('lastName', 'text', array('label' => 'profile.lastName.label', 'required' => false));

        $builder->add('birthday', 'date',
            array('label' => 'profile.birthday.label', 'widget' => 'single_text', 'format' => 'yyyy-MM-dd',
                'required' => false));

        $builder->add('streetNum', 'integer',
            array('label' => 'profile.streetNum.label', 'precision' => 0, 'required' => false));

        $builder->add('address', 'textarea', array('label' => 'profile.address.label', 'required' => false));

        $builder->add('address2', 'textarea', array('label' => 'profile.address2.label', 'required' => false));

        $builder->add('town', 'text', array('label' => 'profile.town.label', 'required' => false));

        $builder->add('zipCode', 'text', array('label' => 'profile.zipCode.label', 'required' => false));

        $builder->add('country', 'country', array('label' => 'profile.country.label', 'required' => false,
                'empty_value' => 'options.choose',
                'empty_data'  => null));

        $builder->add('phone', 'text', array('label' => 'profile.phone.label', 'required' => false));

        $builder->add('mobile', 'text', array('label' => 'profile.mobile.label', 'required' => false));
    }

    /**
     * (non-PHPdoc) @see \Symfony\Component\Form\FormTypeInterface::getName()
     *
     * @return string
     */
    public function getName()
    {
        return 'UserUpdateProfileForm';
    }

    /**
     * get the default options
     *
     * @return multitype:string multitype:string
     */
    public function getDefaultOptions()
    {
        return array('validation_groups' => array('Default', 'profile'));
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
