<?php

namespace Alluco\AdminBundle\Form\Product;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Alluco\DataBundle\Repository\ProductRepository;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class UpdateParentTForm extends AbstractType
{
	private $selfUrl;

	public function __construct($selfUrl)
	{
		$this->selfUrl = $selfUrl;
	}
    /**
     * Form builder
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $selfUrl = $this->selfUrl;
        $builder->add(
            'productParent',
            'entity', array(
                'label' => 'Product.productParent.label',
                'class' => 'AllucoDataBundle:Product',
                'query_builder' => function (ProductRepository $pr) use ($selfUrl) {
                    $qb = $pr->createQueryBuilder('p')->where('p.pageUrlFull NOT LIKE :url');
                    $qb->setParameter('url', $selfUrl.'%');
                    return $qb->addOrderBy('p.pageUrlFull', 'ASC');
                },
                'property' => 'pageUrlFull',
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

        return 'ProductUpdateParentForm';

    }

    /**
     * get the default options
     *
     * @return multitype:string multitype:string
     */
    public function getDefaultOptions()
    {

        return array('validation_groups' => array('productParent'));

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
