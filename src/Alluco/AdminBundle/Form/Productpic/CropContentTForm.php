<?php

namespace Alluco\AdminBundle\Form\Productpic;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class CropContentTForm extends AbstractType
{

    private $filename;

    /**
     * Constructor
     *
     * @param string $filename
     */
    public function __construct($filename = null)
    {

        $this->filename = $filename;

    }

    /**
     * Form builder
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('x1', 'hidden', array('required' => true));

        $builder->add('y1', 'hidden', array('required' => true));

        $builder->add('w', 'hidden', array('required' => true));

        $builder->add('h', 'hidden', array('required' => true));

        $builder->add('filename_tmp', 'hidden', array('data' => $this->filename, 'required' => true));
    }

    /**
     * (non-PHPdoc) @see \Symfony\Component\Form\FormTypeInterface::getName()
     *
     * @return string
     */
    public function getName()
    {

        return 'ProductpicCropContentForm';

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
