<?php

namespace Alluco\AdminBundle\Form\User;

use Alluco\DataBundle\Repository\LangRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class UpdatePreferedLangTForm extends AbstractType
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
    }

    /**
     * (non-PHPdoc) @see \Symfony\Component\Form\FormTypeInterface::getName()
     *
     * @return string
     */
    public function getName()
    {

        return 'UserUpdatePreferedLangForm';

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
