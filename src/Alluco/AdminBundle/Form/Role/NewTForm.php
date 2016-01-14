<?php

namespace Alluco\AdminBundle\Form\Role;

use Alluco\DataBundle\Repository\RoleRepository;
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

        $builder->add(
            'parents',
            'entity',
            array(
                'label' => 'Role.parents.label',
                'class' => 'AllucoDataBundle:Role',
                'query_builder' => function (RoleRepository $rr) {
                    return $rr->createQueryBuilder('r')->orderBy('r.name', 'ASC');
                },
                'property' => 'name',
                'multiple' => true,
                'by_reference' => true,
                'required' => false
            )
        );

        $builder->add('name', 'text', array('label' => 'Role.name.label'));

        $builder->add('description', 'textarea', array('label' => 'Role.description.label', 'required' => false));
    }

    /**
     * (non-PHPdoc) @see \Symfony\Component\Form\FormTypeInterface::getName()
     *
     * @return string
     */
    public function getName()
    {

        return 'RoleNewForm';

    }

    /**
     * get the default options
     *
     * @return multitype:string multitype:string
     */
    public function getDefaultOptions()
    {

        return array('validation_groups' => array('name'));

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
