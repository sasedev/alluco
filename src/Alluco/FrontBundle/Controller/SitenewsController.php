<?php

namespace Alluco\FrontBundle\Controller;

use Sasedev\Commons\SharedBundle\Controller\BaseController;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class SitenewsController extends BaseController
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

        $this->gvars['menu_active'] = 'sitenews';

    }

    public function listAction($page = 1)
    {

        $em = $this->getEntityManager();
        $root = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/'));
        $this->gvars['root'] = $root;

        $staticpage = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/news'));
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

        $query = $em->getRepository('AllucoDataBundle:Sitenew')->getAllQuery();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($query, $page, 3);
        $pagination->setPageRange(3);
        $this->gvars['newsList'] = $pagination;

        return $this->renderResponse('AllucoFrontBundle:News:list.html.twig', $this->gvars);
    }

    public function showAction($pageUrl)
    {


        $em = $this->getEntityManager();
        $root = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/'));
        $this->gvars['root'] = $root;
        $rootnews = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/news'));
        $this->gvars['rootnews'] = $rootnews;

        $sitenew = $em->getRepository('AllucoDataBundle:Sitenew')->findOneBy(array('pageUrl' => $pageUrl));
        if (null == $sitenew) {
            return $this->redirect($this->generateUrl('_front_sitenews'));
        }
        $this->gvars['sitenew'] = $sitenew;

        $this->gvars['pagetitle_txt'] = $sitenew->getMetaTitleTrans();
        $this->gvars['pagetitle'] = $sitenew->getPageTitleTrans();

        $metas = array();
        if (null != $sitenew->getMetaKeywordsTrans()) {
            $meta = array();
            $meta['name'] = 'keywords';
            $meta['content'] = $sitenew->getMetaKeywordsTrans();
            $metas[] = $meta;
        }
        if (null != $sitenew->getMetaDescriptionTrans()) {
            $meta = array();
            $meta['name'] = 'description';
            $meta['content'] = $sitenew->getMetaDescriptionTrans();
            $metas[] = $meta;
        }
        $this->gvars['metas'] = $metas;

        $banners = $em->getRepository('AllucoDataBundle:Banner')->getAll();
        $this->gvars['banners'] = $banners;

        $news = $em->getRepository('AllucoDataBundle:Sitenew')->getLimited(1);
        $this->gvars['news'] = $news;

        $groups = $em->getRepository('AllucoDataBundle:Product')->getRoots();
        $this->gvars['groups'] = $groups;

        return $this->renderResponse('AllucoFrontBundle:News:show.html.twig', $this->gvars);
    }
}