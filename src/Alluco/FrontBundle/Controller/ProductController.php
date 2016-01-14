<?php

namespace Alluco\FrontBundle\Controller;

use Sasedev\Commons\SharedBundle\Controller\BaseController;
use Alluco\DataBundle\Entity\Product;
use Alluco\DataBundle\Entity\Productdoc;
//use Alluco\DataBundle\Entity\Productpic;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class ProductController extends BaseController
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

        $this->gvars['menu_active'] = 'product';

    }

    public function listAction()
    {

        $em = $this->getEntityManager();
        $root = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/'));
        $this->gvars['root'] = $root;

        $staticpage = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/prods'));
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

        return $this->renderResponse('AllucoFrontBundle:Product:list.html.twig', $this->gvars);
    }

    public function showAction($group)
    {
        $em = $this->getEntityManager();
        $root = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/'));
        $this->gvars['root'] = $root;
        $rootprods = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/prods'));
        $this->gvars['rootprods'] = $rootprods;


        $prodgroup = $em->getRepository('AllucoDataBundle:Product')->findOneBy(array('pageUrlFull' => $group));
        if (null == $prodgroup) {
            return $this->redirect($this->generateUrl('_front_productgroups'));
        }
        $this->gvars['product'] = $prodgroup;

        $this->gvars['pagetitle_txt'] = $prodgroup->getMetaTitle();
        $this->gvars['pagetitle'] = $prodgroup->getPageTitleTrans();

        $metas = array();
        if (null != $prodgroup->getMetaKeywordsTrans()) {
            $meta = array();
            $meta['name'] = 'keywords';
            $meta['content'] = $prodgroup->getMetaKeywordsTrans();
            $metas[] = $meta;
        }
        if (null != $prodgroup->getMetaDescriptionTrans()) {
            $meta = array();
            $meta['name'] = 'description';
            $meta['content'] = $prodgroup->getMetaDescriptionTrans();
            $metas[] = $meta;
        }
        $this->gvars['metas'] = $metas;

        $banners = $em->getRepository('AllucoDataBundle:Banner')->getAll();
        $this->gvars['banners'] = $banners;

        $news = $em->getRepository('AllucoDataBundle:Sitenew')->getLimited(1);
        $this->gvars['news'] = $news;

        $groups = $em->getRepository('AllucoDataBundle:Product')->getRoots();
        $this->gvars['groups'] = $groups;

        return $this->renderResponse('AllucoFrontBundle:Product:show.html.twig', $this->gvars);
    }

    public function docsAction()
    {

        $this->gvars['menu_active'] = 'docs';

        $em = $this->getEntityManager();
        $root = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/'));
        $this->gvars['root'] = $root;

        $staticpage = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/docs'));
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

        $docs = $em->getRepository('AllucoDataBundle:Productdoc')->getAll();
        $this->gvars['docs'] = $docs;

        return $this->renderResponse('AllucoFrontBundle:Product:docs.html.twig', $this->gvars);
    }

    /**
     * Search Company with pagination 10/page
     *
     * @param integer $page
     *
     * @return Response
     */
    public function searchAction($page = 1)
    {

        $em = $this->getEntityManager();

        $request = $this->getRequest();
        $q = $request->get('q');
        if (null == $q || trim($q) == "") {
            return $this->redirect($this->generateUrl("_front_productgroups"));
        }
        $q = trim($q);
        $count = $em->getRepository('AllucoDataBundle:Product')->countSearch($q);
        $query = $em->getRepository('AllucoDataBundle:Product')->searchQuery($q);

        $root = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/'));
        $this->gvars['root'] = $root;
        $rootprods = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/prods'));
        $this->gvars['rootprods'] = $rootprods;

        $staticpage = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/search'));
        if (null != $staticpage) {
            $this->gvars['pagetitle_txt'] = $staticpage->getMetaTitleTrans().' '.$q;
            $this->gvars['pagetitle'] = $staticpage->getPageTitleTrans().' '.$q;
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

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($query, $page, 10);
        $pagination->setPageRange(10);

        $this->gvars['searchProds'] = $pagination;
        $this->gvars['countQ'] = $count;
        $this->gvars['q'] = $q;
        return $this->renderResponse('AllucoFrontBundle:Product:search.html.twig', $this->gvars);

    }

    public function downloadAction($docid) {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_front_docs');
        }
        $em = $this->getEntityManager();
        try {
            $doc = $em->getRepository('AllucoDataBundle:Productdoc')->find($docid);

            if (null == $doc) {
                $this->flashMsgSession('warning', 'Doc.download.notfound');
            } else {
                $docDir = $this->getParameter('kernel.root_dir').'/../web/res/docs';
                $fileName = $doc->getFileName();

                try {
                    $dlFile = new File($docDir.'/'.$fileName);
                    $response = new StreamedResponse(function() use($dlFile) {
                        $handle = fopen($dlFile->getRealPath(), 'r');
                        while (!feof($handle)) {
                            $buffer = fread($handle, 1024);
                            echo $buffer;
                            flush();
                        }
                        fclose($handle);
                    });

                        $response->headers->set('Content-Type', $doc->getMimeType());
                        $response->headers->set('Cache-Control', '');
                        $response->headers->set('Content-Length', $doc->getSize());
                        $response->headers->set('Last-Modified', gmdate('D, d M Y H:i:s', $doc->getDtUpdate()->getTimestamp()));
                        $fallback = $this->normalize($doc->getOriginalName());
                        $contentDisposition = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $doc->getOriginalName(), $fallback);
                        $response->headers->set('Content-Disposition', $contentDisposition);

                        $doc->setNbrDownloads($doc->getNbrDownloads() + 1);
                        $em->persist($doc);
                        $em->flush();

                        return $response;
                } catch (FileNotFoundException $fnfex) {
                    $this->flashMsgSession('warning', 'Productdoc.download.error');
                }

                $this->flashMsgSession(
                    'success',
                    $this->translate('Doc.delete.success', array('%doc%' => $doc->getOriginalName()))
                );
            }
        } catch (\Exception $e) {
            $logger = $this->getLogger();
            $logger->addCritical($e->getLine().' '.$e->getMessage().' '.$e->getTraceAsString());

            $this->flashMsgSession('error', $this->translate('Doc.delete.failure'));
        }

        return $this->redirect($urlFrom);
    }

    public function widgetChildsAction($parent, $current = null) {
        $this->gvars['current'] = $current;
        $this->gvars['groups'] = $parent->getChilds();
        return $this->renderResponse('AllucoFrontBundle:Product:childs.html.twig', $this->gvars);
    }

    public function widgetBreadcrumbAction($group, $active) {
        $this->gvars['group'] = $group;
        $this->gvars['active'] = $active;
        return $this->renderResponse('AllucoFrontBundle:Product:breadcrumb.html.twig', $this->gvars);
    }



}