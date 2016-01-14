<?php
namespace Alluco\AdminBundle\Controller;

use Alluco\DataBundle\Entity\Banner;
use Alluco\DataBundle\Entity\BannerTrans;
use Alluco\DataBundle\Entity\Lang;
use Alluco\AdminBundle\Form\Banner\NewTForm as BannerNewTForm;
use Alluco\AdminBundle\Form\Banner\UpdateContentTForm as BannerUpdateContentTForm;
use Alluco\AdminBundle\Form\Banner\UpdateInfoTForm as BannerUpdateInfoTForm;
use Alluco\AdminBundle\Form\Banner\UpdateRankTForm as BannerUpdateRankTForm;
use Alluco\AdminBundle\Form\BannerTrans\UpdateInfoTForm as BannerTransUpdateInfoTForm;
use Sasedev\Commons\SharedBundle\Controller\BaseController;

/**
 * @author sasedev <sasedev.bifidis@gmail.com>
 *
 */
class BannerController extends BaseController
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

        $this->gvars['menu_active'] = 'banner';

    }

    public function listAction()
    {
        $em = $this->getEntityManager();
        $banners = $em->getRepository('AllucoDataBundle:Banner')->getAll();
        $this->gvars['banners'] = $banners;

        $this->gvars['smenu_active'] = 'list';
        $this->gvars['pagetitle'] = $this->translate('Pagetitle.banner.list');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.banner.list.txt');
        return $this->renderResponse('AllucoAdminBundle:Banner:list.html.twig', $this->gvars);
    }

    public function addGetAction()
    {
        $banner = new Banner();
        $bannerNewForm = $this->createForm(new BannerNewTForm(), $banner);
        $this->gvars['banner'] = $banner;
        $this->gvars['BannerNewForm'] = $bannerNewForm->createView();

        $this->gvars['pagetitle'] = $this->translate('Pagetitle.banner.add');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.banner.add.txt');
        $this->gvars['smenu_active'] = 'add';

        return $this->renderResponse('AllucoAdminBundle:Banner:add.html.twig', $this->gvars);
    }

    public function addPostAction()
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            return $this->redirect($this->generateUrl('_admin_banner_addGet'));
        }

        $banner = new Banner();
        $bannerNewForm = $this->createForm(new BannerNewTForm(), $banner);

        $request = $this->getRequest();
        $reqData = $request->request->all();

        if (isset($reqData['BannerNewForm'])) {
            $bannerNewForm->handleRequest($request);
            if ($bannerNewForm->isValid()) {
                $em = $this->getEntityManager();
                $bannerUrl = $bannerNewForm['filename']->getData();

                $bannerDir = $this->getParameter('kernel.root_dir').'/../web/res/banners';

                $fileName = sha1(uniqid(mt_rand(), true)).'.'.strtolower($bannerUrl->getClientOriginalExtension());
                $bannerUrl->move($bannerDir, $fileName);

                $banner->setFilename($fileName);
                $em->persist($banner);
                $em->flush();

                $langs = $em->getRepository('AllucoDataBundle:Lang')->getAll();
                foreach ($langs as $lang) {
                    $bannerTrans = new BannerTrans();
                    $bannerTrans->setBanner($banner);
                    $bannerTrans->setLang($lang);
                    $bannerTrans->setAlt($banner->getAlt());
                    $bannerTrans->setTitle($banner->getTitle());
                    try {
                        $em->persist($bannerTrans);
                        $em->flush();
                    } catch (\Exception $e) {
                        // ne rien faire
                    }
                }

                $this->flashMsgSession(
                    'success',
                    $this->translate('Banner.add.success', array('%banner%' => $banner->getFilename()))
                );

                return $this->redirect(
                    $this->generateUrl('_admin_banner_editGet', array('id' => $banner->getId()))
                );
            } else {
                $this->flashMsgSession(
                    'error',
                    $this->translate('Banner.add.failure', array('%banner%' => $bannerNewForm['alt']->getData()))
                );
            }
        }
        $this->gvars['banner'] = $banner;
        $this->gvars['BannerNewForm'] = $bannerNewForm->createView();

        $this->gvars['pagetitle'] = $this->translate('Pagetitle.banner.add');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.banner.add.txt');
        $this->gvars['smenu_active'] = 'add';

        return $this->renderResponse('AllucoAdminBundle:Banner:add.html.twig', $this->gvars);
    }

    public function deleteAction($id)
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_admin_banner_list');
        }
        $em = $this->getEntityManager();
        try {
            $banner = $em->getRepository('AllucoDataBundle:Banner')->find($id);

            if (null == $banner) {
                $this->flashMsgSession('warning', 'Banner.delete.notfound');
            } else {
                $em->remove($banner);
                $em->flush();

                $this->flashMsgSession(
                    'success',
                    $this->translate('Banner.delete.success', array('%banner%' => $banner->getFilename()))
                );
            }
        } catch (\Exception $e) {
            $logger = $this->getLogger();
            $logger->addCritical($e->getLine().' '.$e->getMessage().' '.$e->getTraceAsString());

            $this->flashMsgSession('error', $this->translate('Banner.delete.failure'));
        }

        return $this->redirect($urlFrom);

    }

    public function editGetAction($id)
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_admin_banner_list');
        }

        $em = $this->getEntityManager();
        try {
            $banner = $em->getRepository('AllucoDataBundle:Banner')->find($id);

            if (null == $banner) {
                $this->flashMsgSession('warning', 'Banner.edit.notfound');
            } else {
                $bannerUpdateContentForm = $this->createForm(new BannerUpdateContentTForm(), $banner);
                $bannerUpdateRankForm = $this->createForm(new BannerUpdateRankTForm(), $banner);
                $bannerUpdateInfoForm = $this->createForm(new BannerUpdateInfoTForm(), $banner);

                $this->gvars['banner'] = $banner;
                $this->gvars['BannerUpdateContentForm'] = $bannerUpdateContentForm->createView();
                $this->gvars['BannerUpdateRankForm'] = $bannerUpdateRankForm->createView();
                $this->gvars['BannerUpdateInfoForm'] = $bannerUpdateInfoForm->createView();

                $langs = $em->getRepository('AllucoDataBundle:Lang')->getAll();
                $this->gvars['langs'] = $langs;
                foreach ($langs as $lang) {
                    $bannerTrans = $em->getRepository('AllucoDataBundle:BannerTrans')->findOneBy(array('lang' => $lang, 'banner' => $banner));
                    if (null == $bannerTrans) {
                        $bannerTrans = new BannerTrans();
                        $bannerTrans->setBanner($banner);
                        $bannerTrans->setLang($lang);
                        $bannerTrans->setAlt($banner->getAlt());
                        $bannerTrans->setTitle($banner->getTitle());
                        try {
                            $em->persist($bannerTrans);
                            $em->flush();
                        } catch (\Exception $e) {
                            // ne rien faire
                        }
                    }
                }

                $em->refresh($banner);


                foreach ($banner->getI18ns() as $bannerTrans) {
                    $bannerTransUpdateInfoForm = $this->createForm(new BannerTransUpdateInfoTForm($bannerTrans->getLang()->getLocale()), $bannerTrans);
                    $this->gvars['BannerTransUpdateInfoForm'][$bannerTrans->getLang()->getLocale()] = $bannerTransUpdateInfoForm->createView();
                }

                $this->gvars['tabActive'] = $this->getSession()->get('tabActive', 1);
                $this->getSession()->remove('tabActive');



                $this->gvars['pagetitle'] = $this->translate('Pagetitle.banner.edit', array('%banner%' => $banner->getFilename()));
                $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.banner.edit.txt', array('%banner%' => $banner->getFilename()));

                return $this->renderResponse('AllucoAdminBundle:Banner:edit.html.twig', $this->gvars);
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
            return $this->redirect($this->generateUrl('_admin_banner_list'));
        }

        $em = $this->getEntityManager();
        try {
            $banner = $em->getRepository('AllucoDataBundle:Banner')->find($id);

            if (null == $banner) {
                $this->flashMsgSession('warning', 'Banner.edit.notfound');
            } else {
                $bannerUpdateContentForm = $this->createForm(new BannerUpdateContentTForm(), $banner);
                $bannerUpdateRankForm = $this->createForm(new BannerUpdateRankTForm(), $banner);
                $bannerUpdateInfoForm = $this->createForm(new BannerUpdateInfoTForm(), $banner);

                $langs = $em->getRepository('AllucoDataBundle:Lang')->getAll();
                $this->gvars['langs'] = $langs;
                foreach ($langs as $lang) {
                    $bannerTrans = $em->getRepository('AllucoDataBundle:BannerTrans')->findOneBy(array('lang' => $lang, 'banner' => $banner));
                    if (null == $bannerTrans) {
                        $bannerTrans = new BannerTrans();
                        $bannerTrans->setBanner($banner);
                        $bannerTrans->setLang($lang);
                        $bannerTrans->setAlt($banner->getAlt());
                        $bannerTrans->setTitle($banner->getTitle());
                        try {
                            $em->persist($bannerTrans);
                            $em->flush();
                        } catch (\Exception $e) {
                            // ne rien faire
                        }
                    }
                }

                $em->refresh($banner);



                $this->gvars['tabActive'] = $this->getSession()->get('tabActive', 2);
                $this->getSession()->remove('tabActive');

                $request = $this->getRequest();
                $reqData = $request->request->all();

                if (isset($reqData['BannerUpdateContentForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $bannerUpdateContentForm->handleRequest($request);
                    if ($bannerUpdateContentForm->isValid()) {

                        $bannerUrl = $bannerUpdateContentForm['filename']->getData();

                        $bannerDir = $this->getParameter('kernel.root_dir').'/../web/res/banners';

                        $fileName = sha1(uniqid(mt_rand(), true)).'.'.strtolower($bannerUrl->getClientOriginalExtension());
                        $bannerUrl->move($bannerDir, $fileName);

                        $banner->setFilename($fileName);
                        $em->persist($banner);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('Banner.edit.success', array('%banner%' => $banner->getFilename()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($banner);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('Banner.edit.failure', array('%banner%' => $banner->getFilename()))
                        );
                    }
                } elseif (isset($reqData['BannerUpdateRankForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $bannerUpdateRankForm->handleRequest($request);
                    if ($bannerUpdateRankForm->isValid()) {
                        $em->persist($banner);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('Banner.edit.success', array('%banner%' => $banner->getFilename()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($banner);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('Banner.edit.failure', array('%banner%' => $banner->getFilename()))
                        );
                    }
                } elseif (isset($reqData['BannerUpdateInfoForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $bannerUpdateInfoForm->handleRequest($request);
                    if ($bannerUpdateInfoForm->isValid()) {
                        $em->persist($banner);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('Banner.edit.success', array('%banner%' => $banner->getFilename()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($banner);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('Banner.edit.failure', array('%banner%' => $banner->getFilename()))
                        );
                    }
                }

                foreach ($banner->getI18ns() as $bannerTrans) {
                    $em->refresh($bannerTrans);
                    $bannerTransUpdateInfoForm = $this->createForm(new BannerTransUpdateInfoTForm($bannerTrans->getLang()->getLocale()), $bannerTrans);
                    if (isset($reqData['BannerTransUpdateInfoForm_'.$bannerTrans->getLang()->getLocale()])) {
                        $this->gvars['tabActive'] = $bannerTrans->getLang()->getLocale();
                        $this->getSession()->set('tabActive', $bannerTrans->getLang()->getLocale());
                        $bannerTransUpdateInfoForm->handleRequest($request);
                        if ($bannerTransUpdateInfoForm->isValid()) {
                            $em->persist($bannerTrans);
                            $em->flush();
                            $this->flashMsgSession(
                                'success',
                                $this->translate('BannerTrans.edit.success', array('%banner%' => $banner->getFilename()))
                            );

                            return $this->redirect($urlFrom);
                        } else {
                            $em->refresh($banner);

                            $this->flashMsgSession(
                                'error',
                                $this->translate('BannerTrans.edit.failure', array('%banner%' => $banner->getFilename()))
                            );
                        }
                    }
                    $this->gvars['BannerTransUpdateInfoForm'][$bannerTrans->getLang()->getLocale()] = $bannerTransUpdateInfoForm->createView();
                }

                $this->gvars['banner'] = $banner;
                $this->gvars['BannerUpdateContentForm'] = $bannerUpdateContentForm->createView();
                $this->gvars['BannerUpdateRankForm'] = $bannerUpdateRankForm->createView();
                $this->gvars['BannerUpdateInfoForm'] = $bannerUpdateInfoForm->createView();

                $this->gvars['pagetitle'] = $this->translate('Pagetitle.banner.edit', array('%banner%' => $banner->getFilename()));
                $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.banner.edit.txt', array('%banner%' => $banner->getFilename()));

                return $this->renderResponse('AllucoAdminBundle:Banner:edit.html.twig', $this->gvars);
            }
        } catch (\Exception $e) {
            $logger = $this->getLogger();
            $logger->addCritical($e->getLine().' '.$e->getMessage().' '.$e->getTraceAsString());
        }

        return $this->redirect($urlFrom);

    }
}
