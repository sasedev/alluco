<?php

namespace Alluco\AdminBundle\Form\User;

use Alluco\DataBundle\Entity\User;
use Alluco\DataBundle\Repository\RoleRepository;
use Alluco\DataBundle\Repository\LangRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class NewTForm extends AbstractType
{

    /**
     * Form builder
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text', array('label' => 'User.username.label'));

        $builder->add('email', 'email', array('label' => 'User.email.label'));

        $builder->add('lockout', 'choice', array('label' => 'User.lockout.label', 'choices' => User::choiceLockout()));


        $builder->add(
            'preferedLang',
            'entity',
            array(
                'label' => 'User.preferedLang.label',
                'class' => 'AllucoDataBundle:Lang',
                'query_builder' => function (LangRepository $lr) {
                    return $lr->createQueryBuilder('l')->orderBy('l.locale', 'ASC');
                },
                'property' => 'name',
                'multiple' => false,
                'by_reference' => true,
                'required' => false,
                'empty_value' => 'Action.choose',
                'empty_data'  => null
            )
        );

        //$builder->add('avatar', 'file', array('label' => 'User.avatar.label', 'required' => false));

        $builder->add('sexe', 'choice', array('label' => 'User.sexe.label', 'choices' => User::choiceSexe()));

        $builder->add('firstName', 'text', array('label' => 'User.firstName.label', 'required' => false));

        $builder->add('lastName', 'text', array('label' => 'User.lastName.label', 'required' => false));

        $builder->add('birthday', 'date', array('label' => 'User.birthday.label', 'widget' => 'single_text', 'format' => 'yyyy-MM-dd', 'required' => false));

        $builder->add('streetNum', 'integer', array('label' => 'User.streetNum.label', 'precision' => 0, 'required' => false));

        $builder->add('address', 'textarea', array('label' => 'User.address.label', 'required' => false));

        $builder->add('address2', 'textarea', array('label' => 'User.address2.label', 'required' => false));

        $builder->add('town', 'text', array('label' => 'User.town.label', 'required' => false));

        $builder->add('zipCode', 'text', array('label' => 'User.zipCode.label', 'required' => false));

        $builder->add('country', 'country', array('label' => 'User.country.label', 'required' => false, 'empty_value' => 'Action.choose', 'empty_data'  => null));

        $builder->add('phone', 'text', array('label' => 'User.phone.label', 'required' => false));

        $builder->add('mobile', 'text', array('label' => 'User.mobile.label', 'required' => false));


        $builder->add(
            'userRoles',
            'entity',
            array(
                'label' => 'User.userRoles.label',
                'class' => 'AllucoDataBundle:Role',
                'query_builder' => function (RoleRepository $rr) {
                    return $rr->createQueryBuilder('r')->orderBy('r.name', 'ASC');
                },
                'property' => 'name',
                'multiple' => true,
                'by_reference' => true,
                'required' => true
            )
        );
    }

    /**
     * (non-PHPdoc) @see \Symfony\Component\Form\FormTypeInterface::getName()
     *
     * @return string
     */
    public function getName()
    {

        return 'UserNewForm';

    }

    /**
     * get the default options
     *
     * @return multitype:string multitype:string
     */
    public function getDefaultOptions()
    {

        return array('validation_groups' => array('Default', 'admRegistration'));

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
