<?php

namespace Alluco\AdminBundle\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Image;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class CropAvatarTForm extends AbstractType
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

        $builder->add('avatar_tmp', 'hidden', array('data' => $this->filename, 'required' => true));
    }

    /**
     * (non-PHPdoc) @see \Symfony\Component\Form\FormTypeInterface::getName()
     *
     * @return string
     */
    public function getName()
    {

        return 'UserCropAvatarForm';

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
