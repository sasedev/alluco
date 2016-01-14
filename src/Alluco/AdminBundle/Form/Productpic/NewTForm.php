<?php

namespace Alluco\AdminBundle\Form\Productpic;

use Alluco\DataBundle\Entity\Productpic;
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

    private $product;

    /**
     * Constructor
     *
     * @param Product $product
     */
    public function __construct($product = null)
    {

        $this->product = $product;

    }
    /**
     * Form builder
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (null == $this->product) {
            $builder->add(
                'product',
                'entity',
                array(
                    'label' => 'Productpic.product.label',
                    'class' => 'AllucoDataBundle:Product',
                    'query_builder' => function (ProductRepository $pr) {
                        return $pr->createQueryBuilder('p')->orderBy('p.rank', 'DESC');
                    },
                    'property' => 'name',
                    'multiple' => false,
                    'by_reference' => true,
                    'required' => true
                )
            );
        } else {
            $product_id = $this->product->getId();
            $builder->add(
                'product',
                'entityid',
                array(
                    'label' => 'Productpic.product.label',
                    'class' => 'AllucoDataBundle:Product',
                    'query_builder' => function (ProductRepository $pr) use ($product_id) {
                        return $pr->createQueryBuilder('p')
                            ->where('p.id = :id')
                            ->setParameter('id', $product_id)
                            ->orderBy('p.rank', 'DESC');
                    },
                    'property' => 'id',
                    'multiple' => false,
                    'by_reference' => true,
                    'required' => true,

                )
            );
        }

        $builder->add('filename', 'file', array('label' => 'Productpic.filename.label'));

        $builder->add('alt', 'text', array('label' => 'Productpic.alt.label'));

        $builder->add('title', 'text', array('label' => 'Productpic.title.label', 'required' => false));

        $builder->add('rank', 'integer', array('label' => 'Productpic.rank.label'));

    }

    /**
     * (non-PHPdoc) @see \Symfony\Component\Form\FormTypeInterface::getName()
     *
     * @return string
     */
    public function getName()
    {

        return 'ProductpicNewForm';

    }

    /**
     * get the default options
     *
     * @return multitype:string multitype:string
     */
    public function getDefaultOptions()
    {

        return array('validation_groups' => array('filename', 'alt', 'rank'));

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
