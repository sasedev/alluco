<?php

namespace Alluco\SecurityBundle\Form;

use Alluco\DataBundle\Repository\LangRepository;

use Alluco\DataBundle\Repository\JobRepository;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Alluco\DataBundle\Entity\User;
use Alluco\DataBundle\Entity\Job;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class RegisterTForm extends AbstractType
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

        $builder->add('username', 'text', array('label' => 'profile.username.label'));

        $builder->add('email', 'email', array('label' => 'profile.email.label'));

        $builder->add('clearPassword', 'password', array('label' => 'profile.password.label'));

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
                'empty_value' => 'Options.choose',
                'empty_data'  => null));

        $builder->add('phone', 'text', array('label' => 'profile.phone.label', 'required' => false));

        $builder->add('mobile', 'text', array('label' => 'profile.mobile.label', 'required' => false));

        $builder->add('fax', 'text', array('label' => 'profile.fax.label', 'required' => false));

        $builder->add('company', 'text', array('label' => 'profile.company.label', 'required' => false));

        $builder->add('fisc', 'text', array('label' => 'profile.fisc.label', 'required' => false));

        $builder->add('userType', 'choice', array('label' => 'profile.userType.label', 'choices' => User::choiceUserType()));

        $builder->add('preferedLang', 'entity',
            array('label' => 'profile.preferedLang.label', 'class' => 'AllucoDataBundle:Lang',
                'query_builder' => function (LangRepository $lr)
                {
                    return $lr->createQueryBuilder('l')
                        ->orderBy('l.locale', 'ASC');
                }, 'property' => 'name', 'multiple' => false, 'by_reference' => true, 'required' => false,
                'empty_value' => 'options.choose',
                'empty_data'  => null));

        $builder->add('job', 'entity',
            array('label' => 'profile.job.label', 'class' => 'AllucoDataBundle:Job',
                'query_builder' => function (JobRepository $jr)
                {
                    return $jr->createQueryBuilder('j')
                    ->where('j.status = :status')
                    ->orderBy('j.rank', 'DESC')
                    ->setParameter('status', Job::ST_ENABLED);
                }, 'property' => 'nameTrans', 'multiple' => false, 'by_reference' => true, 'required' => true));

        $builder->add('otherInfos', 'textarea', array('label' => 'profile.otherInfos.label', 'required' => false));

        $builder->add('captcha', 'captcha', array('label' => 'profile.captcha.label', 'width' => 250,
            'height' => 60,
            'length' => 6,
            'quality' => 100,
            'as_file' => true
        ));

        $builder->add('submit', 'submit', array('label' => 'action.btnRegister'));
    }

    /**
     * (non-PHPdoc) @see \Symfony\Component\Form\FormTypeInterface::getName()
     *
     * @return string
     */
    public function getName()
    {
        return 'RegisterForm';
    }

    /**
     * get the default options
     *
     * @return multitype:string multitype:string
     */
    public function getDefaultOptions()
    {
        return array('validation_groups' => array('Default', 'create', 'username', 'email'));
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