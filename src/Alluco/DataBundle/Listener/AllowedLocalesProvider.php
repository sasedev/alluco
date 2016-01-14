<?php

namespace Alluco\DataBundle\Listener;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Doctrine\ORM\EntityManager;
use Alluco\DataBundle\Entity\Lang;
use Lunetics\LocaleBundle\LocaleInformation\AllowedLocalesProvider as BaseLocalesProvider;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class AllowedLocalesProvider extends BaseLocalesProvider
{
    /**
     *
     * @var EntityManager
     */
    private $em;

    /**
     *
     * @param array $hierarchy
     */
    public function __construct(Doctrine $doctrine)
    {
        $this->em = $doctrine->getManager();
    }

    /**
     * @return EntityManager
     */
    public function getEntitymanager()
    {
        return $this->em;
    }

    /**
     * Return a list of the allowed locales
     *
     * @return array
     */
    public function getAllowedLocales()
    {
        $langs = $this->getEntitymanager()
        ->getRepository('AllucoDataBundle:Lang')
        ->getAllEnabled();
        $alloweds = array();
        foreach ($langs as $lang) {
            $alloweds[] = $lang->getLocale();
        }
        return $alloweds;

    }

    /**
     * Set the list of the allowed locales
     *
     * @param array $allowedLocales
     */
    public function setAllowedLocales($allowedLocales)
    {
        $langs = $this->getEntitymanager()
        ->getRepository('AllucoDataBundle:Lang')
        ->getAllEnabled();
        $alloweds = array();
        foreach ($langs as $lang) {
            $alloweds[] = $lang->getLocale();
        }
        $this->allowedLocales = $alloweds;
    }

    public function updateAllowedLocales()
    {
        $langs = $this->getEntitymanager()
        ->getRepository('AllucoDataBundle:Lang')
        ->getAllEnabled();
        $allowedLocales = array();
        foreach ($langs as $lang) {
            $allowedLocales[] = $lang->getLocale();
        }
        $this->setAllowedLocales($allowedLocales);
    }

}