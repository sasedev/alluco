<?php

namespace Alluco\AdminBundle\Form\User;

use Alluco\DataBundle\Repository\JobRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class UpdateJobTForm extends AbstractType
{

    /**
     * Form builder
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('job', 'entity',
            array('label' => 'User.job.label', 'class' => 'AllucoDataBundle:Job',
                'query_builder' => function (JobRepository $jr)
                {
                    return $jr->createQueryBuilder('j')
                        ->orderBy('j.rank', 'DESC');
                }, 'property' => 'name', 'multiple' => false, 'by_reference' => true, 'required' => true));

        $builder->add('company', 'text', array('label' => 'User.company.label', 'required' => false));

        $builder->add('fisc', 'text', array('label' => 'User.fisc.label', 'required' => false));
    }

    /**
     * (non-PHPdoc) @see \Symfony\Component\Form\FormTypeInterface::getName()
     *
     * @return string
     */
    public function getName()
    {

        return 'UserUpdateJobForm';

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
