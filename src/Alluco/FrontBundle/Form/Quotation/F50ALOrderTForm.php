<?php

namespace Alluco\FrontBundle\Form\Quotation;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class F50ALOrderTForm extends AbstractType
{

	private $height;

	private $widthLR;

	private $widthC;

	private $prof;

	/**
	 * Constructor
	 *
	 * @param Product $product
	 */
	public function __construct($height = 0, $widthLR = 0, $widthC = 0, $prof = 0)
	{

		$this->height = $height;

		$this->widthLR = $widthLR;

		$this->widthC = $widthC;

		$this->prof = $prof;

	}

	/**
	 * Form builder
	 *
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('height', 'hidden', array('data' => $this->height));

		$builder->add('widthLR', 'hidden', array('data' => $this->widthLR));

		$builder->add('widthC', 'hidden', array('data' => $this->widthC));

		$builder->add('prof', 'hidden', array('data' => $this->prof));

		$builder->add('profil3Name', 'choice', array('choices' => array(1 => 'Quotation.f50AL.profil.3.1', 2 => 'Quotation.f50AL.profil.3.2')));

		$builder->add('access1Name', 'choice', array('choices' => array(1 => 'Quotation.f50AL.access.1.1', 2 => 'Quotation.f50AL.access.1.2')));

		$builder->add('access4Name', 'choice', array('choices' => array(1 => 'Quotation.f50AL.access.4.1', 2 => 'Quotation.f50AL.access.4.2', 3 => 'Quotation.f50AL.access.4.3')));

		$builder->add('access6Name', 'choice', array('choices' => array(1 => 'Quotation.f50AL.access.6.1', 2 => 'Quotation.f50AL.access.6.2')));

		$builder->add('access7Name', 'choice', array('choices' => array(1 => 'Quotation.f50AL.access.7.1', 2 => 'Quotation.f50AL.access.7.2')));

		$builder->add('submit', 'submit', array('label' => 'action.btnOrder', 'attr' => array('class'=> 'btn-primary btn')));
	}

	/**
	 * (non-PHPdoc) @see \Symfony\Component\Form\FormTypeInterface::getName()
	 */
	public function getName()
	{
		return "F50ALOrderForm";
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
