<?php

namespace Alluco\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Alluco\DataBundle\Repository\JobRepository;
use Alluco\DataBundle\Entity\Job;
/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class ContactTForm extends AbstractType
{

    /**
     * Form builder
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName', 'text', array('label' => 'contact.firstName.label', 'required' => true));

        $builder->add('lastName', 'text', array('label' => 'contact.lastName.label', 'required' => true));

        $builder->add('email', 'text', array('label' => 'contact.email.label', 'required' => true));

        $builder->add('phone', 'text', array('label' => 'contact.phone.label', 'required' => true));

        $builder->add('job', 'entity',
            array('label' => 'contact.job.label', 'class' => 'AllucoDataBundle:Job',
                'query_builder' => function (JobRepository $jr)
                {
                    return $jr->createQueryBuilder('j')
                    ->where('j.status = :status')
                    ->orderBy('j.rank', 'DESC')
                    ->setParameter('status', Job::ST_ENABLED);
                }, 'property' => 'nameTrans' , 'multiple' => false, 'by_reference' => true, 'required' => true));

        $builder->add('company', 'text', array('label' => 'contact.company.label', 'required' => false));

        $builder->add('subject', 'text', array('label' => 'contact.subject.label', 'required' => true));

        $builder->add('msg', 'textarea', array('label' => 'contact.msg.label', 'required' => true));

        $builder->add('captcha', 'captcha', array('label' => 'contact.captcha.label', 'width' => 250,
            'height' => 60,
            'length' => 6,
            'quality' => 100,
            'as_file' => true
        ));
    }

    /**
     * (non-PHPdoc) @see \Symfony\Component\Form\FormTypeInterface::getName()
     */
    public function getName()
    {
        return "ContactForm";
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
