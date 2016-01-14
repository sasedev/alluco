<?php

namespace Alluco\AdminBundle\Form\Product;

use Alluco\DataBundle\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Image;
use Alluco\DataBundle\Repository\ProductRepository;

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
            'productParent',
            'entity',
            array(
                'label' => 'Product.productParent.label',
                'class' => 'AllucoDataBundle:Product',
                'query_builder' => function (ProductRepository $pr) {
                    return $pr->createQueryBuilder('p')->orderBy('p.pageUrlFull', 'ASC');
                },
                'property' => 'pageUrlFull',
                'multiple' => false,
                'by_reference' => true,
                'required' => false,
                'empty_value' => 'Action.choose',
                'empty_data'  => null
            )
        );

        $builder->add('name', 'text', array('label' => 'Product.name.label'));

        $builder->add('metaTitle', 'text', array('label' => 'Product.metaTitle.label'));

        $builder->add('metaKeywords', 'text', array('label' => 'Product.metaKeywords.label', 'required' => false));

        $builder->add('metaDescription', 'text', array('label' => 'Product.metaDescription.label', 'required' => false));

        $builder->add('pageTitle', 'text', array('label' => 'Product.pageTitle.label'));

        $builder->add('breadcrumb', 'text', array('label' => 'Product.breadcrumb.label'));

        $builder->add('pageContent', 'textarea', array('label' => 'Product.pageContent.label'));

        $builder->add('thumb', 'file', array('label' => 'Product.thumb.label'));

        $builder->add('thumbAlt', 'text', array('label' => 'Product.thumbAlt.label'));

        $builder->add('thumbTitle', 'text', array('label' => 'Product.thumbTitle.label', 'required' => false));

        $builder->add('rank', 'integer', array('label' => 'Product.rank.label', 'required' => false));

    }

    /**
     * (non-PHPdoc) @see \Symfony\Component\Form\FormTypeInterface::getName()
     *
     * @return string
     */
    public function getName()
    {

        return 'ProductNewForm';

    }

    /**
     * get the default options
     *
     * @return multitype:string multitype:string
     */
    public function getDefaultOptions()
    {

        return array('validation_groups' => array('name', 'metaTitle', 'pageTitle', 'breadcrumb', 'pageContent', 'thumb', 'thumbAlt', 'rank'));

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
