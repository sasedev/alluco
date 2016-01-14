<?php

namespace Alluco\AdminBundle\Controller;

use Sasedev\Commons\SharedBundle\Controller\BaseController;

class DefaultController extends BaseController
{

    /**
     *
     * @var array
     */
    protected $gvars = array();

    /**
     * Constructor
     */
    public function __construct()
    {

        $this->gvars['menu_active'] = 'home';

    }

    public function indexAction()
    {

        //$em = $this->getEntityManager();
        //$accounts = $em->getRepository('MedinafilComptaDataBundle:Account')->getAll();
        //$this->gvars['accounts'] = $accounts;

        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.admin.homepage.txt');
        $this->gvars['pagetitle'] = $this->translate('Pagetitle.admin.homepage');

        return $this->renderResponse('AllucoAdminBundle:Default:index.html.twig', $this->gvars);
    }
}