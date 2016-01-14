<?php

namespace Alluco\FrontBundle\Controller;

use Sasedev\Commons\SharedBundle\Controller\BaseController;
use Alluco\DataBundle\Entity\Staticpage;
use Alluco\DataBundle\Entity\Banner;
use Alluco\DataBundle\Entity\Product;
use Alluco\DataBundle\Entity\Sitenew;

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
        $em = $this->getEntityManager();
        $root = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/'));
        if (null != $root) {
            $this->gvars['pagetitle_txt'] = $root->getMetaTitleTrans();
            $this->gvars['pagetitle'] = $root->getPageTitleTrans();
            $metas = array();
            if (null != $root->getMetaKeywordsTrans()) {
                $meta = array();
                $meta['name'] = 'keywords';
                $meta['content'] = $root->getMetaKeywordsTrans();
                $metas[] = $meta;
            }
            if (null != $root->getMetaDescriptionTrans()) {
                $meta = array();
                $meta['name'] = 'description';
                $meta['content'] = $root->getMetaDescriptionTrans();
                $metas[] = $meta;
            }
            $this->gvars['metas'] = $metas;
        }
        $this->gvars['root'] = $root;

        $banners = $em->getRepository('AllucoDataBundle:Banner')->getAll();
        $this->gvars['banners'] = $banners;

        $news = $em->getRepository('AllucoDataBundle:Sitenew')->getLimited(1);
        $this->gvars['news'] = $news;

        $groups = $em->getRepository('AllucoDataBundle:Product')->getRoots();
        $this->gvars['groups'] = $groups;

        return $this->renderResponse('AllucoFrontBundle:Default:index.html.twig', $this->gvars);
    }

    public function certificatsAction()
    {
        $this->gvars['menu_active'] = '';

        $em = $this->getEntityManager();
        $root = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/'));
        $this->gvars['root'] = $root;

        $staticpage = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/certificats'));
        if (null != $staticpage) {
            $this->gvars['pagetitle_txt'] = $staticpage->getMetaTitleTrans();
            $this->gvars['pagetitle'] = $staticpage->getPageTitleTrans();
            $metas = array();
            if (null != $staticpage->getMetaKeywordsTrans()) {
                $meta = array();
                $meta['name'] = 'keywords';
                $meta['content'] = $staticpage->getMetaKeywordsTrans();
                $metas[] = $meta;
            }
            if (null != $staticpage->getMetaDescriptionTrans()) {
                $meta = array();
                $meta['name'] = 'description';
                $meta['content'] = $staticpage->getMetaDescriptionTrans();
                $metas[] = $meta;
            }
            $this->gvars['metas'] = $metas;
        }
        $this->gvars['staticpage'] = $staticpage;

        $banners = $em->getRepository('AllucoDataBundle:Banner')->getAll();
        $this->gvars['banners'] = $banners;

        $news = $em->getRepository('AllucoDataBundle:Sitenew')->getLimited(1);
        $this->gvars['news'] = $news;

        $groups = $em->getRepository('AllucoDataBundle:Product')->getRoots();
        $this->gvars['groups'] = $groups;

        return $this->renderResponse('AllucoFrontBundle:Default:certificats.html.twig', $this->gvars);
    }

    public function partenairesAction()
    {
        $this->gvars['menu_active'] = '';

        $em = $this->getEntityManager();
        $root = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/'));
        $this->gvars['root'] = $root;

        $staticpage = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/partenaires'));
        if (null != $staticpage) {
            $this->gvars['pagetitle_txt'] = $staticpage->getMetaTitleTrans();
            $this->gvars['pagetitle'] = $staticpage->getPageTitleTrans();
            $metas = array();
            if (null != $staticpage->getMetaKeywordsTrans()) {
                $meta = array();
                $meta['name'] = 'keywords';
                $meta['content'] = $staticpage->getMetaKeywordsTrans();
                $metas[] = $meta;
            }
            if (null != $staticpage->getMetaDescriptionTrans()) {
                $meta = array();
                $meta['name'] = 'description';
                $meta['content'] = $staticpage->getMetaDescriptionTrans();
                $metas[] = $meta;
            }
            $this->gvars['metas'] = $metas;
        }
        $this->gvars['staticpage'] = $staticpage;

        $banners = $em->getRepository('AllucoDataBundle:Banner')->getAll();
        $this->gvars['banners'] = $banners;

        $news = $em->getRepository('AllucoDataBundle:Sitenew')->getLimited(1);
        $this->gvars['news'] = $news;

        $groups = $em->getRepository('AllucoDataBundle:Product')->getRoots();
        $this->gvars['groups'] = $groups;

        return $this->renderResponse('AllucoFrontBundle:Default:partenaires.html.twig', $this->gvars);
    }

    public function sitemapAction()
    {
        $this->gvars['menu_active'] = '';

        $em = $this->getEntityManager();

        $ROOTPage = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/'));
        $this->gvars['ROOTPage'] = $ROOTPage;
        $certificatsPage = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/certificats'));
        $this->gvars['certificatsPage'] = $certificatsPage;
        $partenairesPage = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/partenaires'));
        $this->gvars['partenairesPage'] = $partenairesPage;
        $contactPage = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/contact'));
        $this->gvars['contactPage'] = $contactPage;
        $newsPage = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/news'));
        $this->gvars['newsPage'] = $newsPage;
        $prodsPage = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/prods'));
        $this->gvars['prodsPage'] = $prodsPage;
        $docsPage = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/docs'));
        $this->gvars['docsPage'] = $docsPage;

        $news = $em->getRepository('AllucoDataBundle:Sitenew')->getAll();
        $this->gvars['news'] = $news;

        $groups = $em->getRepository('AllucoDataBundle:Product')->getAll();
        $this->gvars['groups'] = $groups;

        return $this->renderResponse('AllucoFrontBundle:Default:sitemap.xml.twig', $this->gvars);
    }
}
