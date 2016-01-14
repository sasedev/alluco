<?php
namespace Alluco\AdminBundle\Controller;

use Alluco\DataBundle\Entity\Lang;
use Alluco\AdminBundle\Form\Lang\NewTForm as LangNewTForm;
use Alluco\AdminBundle\Form\Lang\UpdateStatusTForm as LangUpdateStatusTForm;
use Sasedev\Commons\SharedBundle\Controller\BaseController;
use Alluco\DataBundle\Entity\Job;
use Alluco\DataBundle\Entity\JobTrans;
use Alluco\DataBundle\Entity\Banner;
use Alluco\DataBundle\Entity\BannerTrans;
use Alluco\DataBundle\Entity\Certif;
use Alluco\DataBundle\Entity\CertifTrans;
use Alluco\DataBundle\Entity\Staticpage;
use Alluco\DataBundle\Entity\StaticpageTrans;
use Alluco\DataBundle\Entity\Sitenew;
use Alluco\DataBundle\Entity\SitenewTrans;
use Alluco\DataBundle\Entity\Product;
use Alluco\DataBundle\Entity\ProductTrans;
use Alluco\DataBundle\Entity\Productpic;
use Alluco\DataBundle\Entity\ProductpicTrans;
use Alluco\DataBundle\Entity\Productdoc;
use Alluco\DataBundle\Entity\ProductdocTrans;

/**
 * @author sasedev <sasedev.bifidis@gmail.com>
 *
 */
class LangController extends BaseController
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

        $this->gvars['menu_active'] = 'lang';

    }

    public function listAction()
    {
        $em = $this->getEntityManager();
        $langs = $em->getRepository('AllucoDataBundle:Lang')->getAll();
        $this->gvars['langs'] = $langs;

        $this->gvars['smenu_active'] = 'list';
        $this->gvars['pagetitle'] = $this->translate('Pagetitle.lang.list');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.lang.list.txt');
        return $this->renderResponse('AllucoAdminBundle:Lang:list.html.twig', $this->gvars);
    }

    public function addGetAction()
    {
        $lang = new Lang();
        $langNewForm = $this->createForm(new LangNewTForm(), $lang);
        $this->gvars['lang'] = $lang;
        $this->gvars['LangNewForm'] = $langNewForm->createView();

        $this->gvars['pagetitle'] = $this->translate('Pagetitle.lang.add');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.lang.add.txt');
        $this->gvars['smenu_active'] = 'add';

        return $this->renderResponse('AllucoAdminBundle:Lang:add.html.twig', $this->gvars);
    }

    public function addPostAction()
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            return $this->redirect($this->generateUrl('_admin_lang_addGet'));
        }

        $lang = new Lang();
        $langNewForm = $this->createForm(new LangNewTForm(), $lang);

        $request = $this->getRequest();
        $reqData = $request->request->all();

        if (isset($reqData['LangNewForm'])) {
            $langNewForm->handleRequest($request);
            if ($langNewForm->isValid()) {
                $em = $this->getEntityManager();
                $em->persist($lang);
                $em->flush();

                $jobs = $em->getRepository('AllucoDataBundle:Job')->getAll();
                foreach ($jobs as $job) {
                    $jobTrans = new JobTrans();
                    $jobTrans->setLang($lang);
                    $jobTrans->setJob($job);
                    $jobTrans->setName($job->getName());
                    $em->persist($jobTrans);
                }

                $banners = $em->getRepository('AllucoDataBundle:Banner')->getAll();
                foreach ($banners as $banner) {
                    $bannerTrans = new BannerTrans();
                    $bannerTrans->setLang($lang);
                    $bannerTrans->setBanner($banner);
                    $bannerTrans->setAlt($banner->getAlt());
                    $bannerTrans->setTitle($banner->getTitle());
                    $em->persist($bannerTrans);
                }

                $certifs = $em->getRepository('AllucoDataBundle:Certif')->getAll();
                foreach ($certifs as $certif) {
                    $certifTrans = new CertifTrans();
                    $certifTrans->setLang($lang);
                    $certifTrans->setCertif($certif);
                    $certifTrans->setTitle($certif->getTitle());
                    $em->persist($certifTrans);
                }

                $staticpages = $em->getRepository('AllucoDataBundle:Staticpage')->getAll();
                foreach ($staticpages as $staticpage) {
                    $staticpageTrans = new StaticpageTrans();
                    $staticpageTrans->setLang($lang);
                    $staticpageTrans->setStaticpage($staticpage);
                    $staticpageTrans->setMetaTitle($staticpage->getMetaTitle());
                    $staticpageTrans->setMetaKeywords($staticpage->getMetaKeywords());
                    $staticpageTrans->setMetaDescription($staticpage->getMetaDescription());
                    $staticpageTrans->setPageTitle($staticpage->getPageTitle());
                    $staticpageTrans->setBreadcrumb($staticpage->getBreadcrumb());
                    $staticpageTrans->setPageContent($staticpage->getPageContent());
                    $em->persist($staticpageTrans);
                }

                $sitenews = $em->getRepository('AllucoDataBundle:Sitenew')->getAll();
                foreach ($sitenews as $sitenew) {
                    $sitenewTrans = new SitenewTrans();
                    $sitenewTrans->setLang($lang);
                    $sitenewTrans->setSitenew($sitenew);
                    $sitenewTrans->setMetaTitle($sitenew->getMetaTitle());
                    $sitenewTrans->setMetaKeywords($sitenew->getMetaKeywords());
                    $sitenewTrans->setMetaDescription($sitenew->getMetaDescription());
                    $sitenewTrans->setPageTitle($sitenew->getPageTitle());
                    $sitenewTrans->setBreadcrumb($sitenew->getBreadcrumb());
                    $sitenewTrans->setPageContent($sitenew->getPageContent());
                    $sitenewTrans->setThumbAlt($sitenew->getThumbAlt());
                    $sitenewTrans->setThumbTitle($sitenew->getThumbTitle());
                    $em->persist($sitenewTrans);
                }

                $products = $em->getRepository('AllucoDataBundle:Product')->getAll();
                foreach ($products as $product) {
                    $productTrans = new ProductTrans();
                    $productTrans->setLang($lang);
                    $productTrans->setProduct($product);
                    $productTrans->setName($product->getName());
                    $productTrans->setMetaTitle($product->getMetaTitle());
                    $productTrans->setMetaKeywords($product->getMetaKeywords());
                    $productTrans->setMetaDescription($product->getMetaDescription());
                    $productTrans->setPageTitle($product->getPageTitle());
                    $productTrans->setBreadcrumb($product->getBreadcrumb());
                    $productTrans->setPageContent($product->getPageContent());
                    $productTrans->setThumbAlt($product->getThumbAlt());
                    $productTrans->setThumbTitle($product->getThumbTitle());
                    $em->persist($productTrans);
                }

                $productpics = $em->getRepository('AllucoDataBundle:Productpic')->getAll();
                foreach ($productpics as $productpic) {
                    $productpicTrans = new ProductpicTrans();
                    $productpicTrans->setLang($lang);
                    $productpicTrans->setProductpic($productpic);
                    $productpicTrans->setAlt($productpic->getAlt());
                    $productpicTrans->setTitle($productpic->getTitle());
                    $em->persist($productpicTrans);
                }

                $productdocs = $em->getRepository('AllucoDataBundle:Productdoc')->getAll();
                foreach ($productdocs as $productdoc) {
                    $productdocTrans = new ProductdocTrans();
                    $productdocTrans->setLang($lang);
                    $productdocTrans->setProductdoc($productdoc);
                    $productdocTrans->setTitle($productdoc->getTitle());
                    $em->persist($productdocTrans);
                }

                $em->flush();


                $this->flashMsgSession(
                    'success',
                    $this->translate('Lang.add.success', array('%lang%' => $lang->getName()))
                );

                return $this->redirect(
                    $this->generateUrl('_admin_lang_editGet', array('id' => $lang->getId()))
                );
            } else {
                $this->flashMsgSession(
                    'error',
                    $this->translate('Lang.add.failure', array('%lang%' => $langNewForm['locale']->getData()))
                );
            }
        }
        $this->gvars['lang'] = $lang;
        $this->gvars['LangNewForm'] = $langNewForm->createView();

        $this->gvars['pagetitle'] = $this->translate('Pagetitle.lang.add');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.lang.add.txt');
        $this->gvars['smenu_active'] = 'add';

        return $this->renderResponse('AllucoAdminBundle:Lang:add.html.twig', $this->gvars);
    }

    public function deleteAction($id)
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_admin_lang_list');
        }
        $em = $this->getEntityManager();
        try {
            $lang = $em->getRepository('AllucoDataBundle:Lang')->find($id);

            if (null == $lang) {
                $this->flashMsgSession('warning', 'Lang.delete.notfound');
            } else {
                $em->remove($lang);
                $em->flush();

                $this->flashMsgSession(
                    'success',
                    $this->translate('Lang.delete.success', array('%lang%' => $lang->getName()))
                );
            }
        } catch (\Exception $e) {
            $logger = $this->getLogger();
            $logger->addCritical($e->getLine().' '.$e->getMessage().' '.$e->getTraceAsString());

            $this->flashMsgSession('error', $this->translate('Lang.delete.failure'));
        }

        return $this->redirect($urlFrom);

    }

    public function editGetAction($id)
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_admin_lang_list');
        }

        $em = $this->getEntityManager();
        try {
            $lang = $em->getRepository('AllucoDataBundle:Lang')->find($id);

            if (null == $lang) {
                $this->flashMsgSession('warning', 'Lang.edit.notfound');
            } else {
                $langUpdateStatusForm = $this->createForm(new LangUpdateStatusTForm(), $lang);

                $this->gvars['lang'] = $lang;
                $this->gvars['LangUpdateStatusForm'] = $langUpdateStatusForm->createView();

                $this->gvars['tabActive'] = $this->getSession()->get('tabActive', 1);
                $this->getSession()->remove('tabActive');



                $this->gvars['pagetitle'] = $this->translate('Pagetitle.lang.edit', array('%lang%' => $lang->getName()));
                $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.lang.edit.txt', array('%lang%' => $lang->getName()));

                return $this->renderResponse('AllucoAdminBundle:Lang:edit.html.twig', $this->gvars);
            }
        } catch (\Exception $e) {
            $logger = $this->getLogger();
            $logger->addCritical($e->getLine().' '.$e->getMessage().' '.$e->getTraceAsString());
        }

        return $this->redirect($urlFrom);
    }


    public function editPostAction($id)
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            return $this->redirect($this->generateUrl('_admin_lang_list'));
        }

        $em = $this->getEntityManager();
        try {
            $lang = $em->getRepository('AllucoDataBundle:Lang')->find($id);

            if (null == $lang) {
                $this->flashMsgSession('warning', 'Lang.edit.notfound');
            } else {
                $langUpdateStatusForm = $this->createForm(new LangUpdateStatusTForm(), $lang);



                $this->gvars['tabActive'] = $this->getSession()->get('tabActive', 2);
                $this->getSession()->remove('tabActive');

                $request = $this->getRequest();
                $reqData = $request->request->all();

                if (isset($reqData['LangUpdateStatusForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $langUpdateStatusForm->handleRequest($request);
                    if ($langUpdateStatusForm->isValid()) {
                        $em->persist($lang);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('Lang.edit.success', array('%lang%' => $lang->getName()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($lang);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('Lang.edit.failure', array('%lang%' => $lang->getName()))
                        );
                    }
                }

                $this->gvars['lang'] = $lang;
                $this->gvars['LangUpdateStatusForm'] = $langUpdateStatusForm->createView();

                $this->gvars['pagetitle'] = $this->translate('Pagetitle.lang.edit', array('%lang%' => $lang->getName()));
                $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.lang.edit.txt', array('%lang%' => $lang->getName()));

                return $this->renderResponse('AllucoAdminBundle:Lang:edit.html.twig', $this->gvars);
            }
        } catch (\Exception $e) {
            $logger = $this->getLogger();
            $logger->addCritical($e->getLine().' '.$e->getMessage().' '.$e->getTraceAsString());
        }

        return $this->redirect($urlFrom);

    }
}
