<?php

namespace Alluco\AdminBundle\Form\Sitenew;

use Alluco\DataBundle\Entity\Sitenew;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Image;

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

        $builder->add('pageUrl', 'text', array('label' => 'Sitenew.pageUrl.label'));

        $builder->add('metaTitle', 'text', array('label' => 'Sitenew.metaTitle.label'));

        $builder->add('metaKeywords', 'text', array('label' => 'Sitenew.metaKeywords.label', 'required' => false));

        $builder->add('metaDescription', 'text', array('label' => 'Sitenew.metaDescription.label', 'required' => false));

        $builder->add('pageTitle', 'text', array('label' => 'Sitenew.pageTitle.label'));

        $builder->add('breadcrumb', 'text', array('label' => 'Sitenew.breadcrumb.label'));

        $builder->add('pageContent', 'textarea', array('label' => 'Sitenew.pageContent.label'));

        $builder->add('thumb', 'file', array('label' => 'Sitenew.thumb.label', 'required' => false));

        $builder->add('thumbAlt', 'text', array('label' => 'Sitenew.thumbAlt.label', 'required' => false));

        $builder->add('thumbTitle', 'text', array('label' => 'Sitenew.thumbTitle.label', 'required' => false));

    }

    /**
     * (non-PHPdoc) @see \Symfony\Component\Form\FormTypeInterface::getName()
     *
     * @return string
     */
    public function getName()
    {

        return 'SitenewNewForm';

    }

    /**
     * get the default options
     *
     * @return multitype:string multitype:string
     */
    public function getDefaultOptions()
    {

        return array('validation_groups' => array('pageUrl', 'metaTitle', 'pageTitle', 'breadcrumb', 'pageContent', 'thumb', 'thumbAlt', 'thumbTitle'));

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
