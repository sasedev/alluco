<?php

namespace Alluco\FrontBundle\Form\Quotation;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class F50AUOrderTForm extends AbstractType
{

	private $height;

	private $widthL;

	private $widthC;

	private $prof;

	/**
	 * Constructor
	 *
	 * @param Product $product
	 */
	public function __construct($height = 0, $widthL = 0, $widthC = 0, $widthR = 0, $prof = 0)
	{

		$this->height = $height;

		$this->widthL = $widthL;

		$this->widthC = $widthC;

		$this->widthR = $widthR;

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

		$builder->add('widthL', 'hidden', array('data' => $this->widthL));

		$builder->add('widthC', 'hidden', array('data' => $this->widthC));

		$builder->add('widthR', 'hidden', array('data' => $this->widthR));

		$builder->add('prof', 'hidden', array('data' => $this->prof));

		$builder->add('profil3Name', 'choice', array('choices' => array(1 => 'Quotation.f50AU.profil.3.1', 2 => 'Quotation.f50AU.profil.3.2')));

		$builder->add('access1Name', 'choice', array('choices' => array(1 => 'Quotation.f50AU.access.1.1', 2 => 'Quotation.f50AU.access.1.2')));

		$builder->add('access4Name', 'choice', array('choices' => array(1 => 'Quotation.f50AU.access.4.1', 2 => 'Quotation.f50AU.access.4.2', 3 => 'Quotation.f50AU.access.4.3')));

		$builder->add('access6Name', 'choice', array('choices' => array(1 => 'Quotation.f50AU.access.6.1', 2 => 'Quotation.f50AU.access.6.2')));

		$builder->add('access7Name', 'choice', array('choices' => array(1 => 'Quotation.f50AU.access.7.1', 2 => 'Quotation.f50AU.access.7.2')));

		$builder->add('submit', 'submit', array('label' => 'action.btnOrder', 'attr' => array('class'=> 'btn-primary btn')));
	}

	/**
	 * (non-PHPdoc) @see \Symfony\Component\Form\FormTypeInterface::getName()
	 */
	public function getName()
	{
		return "F50AUOrderForm";
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
