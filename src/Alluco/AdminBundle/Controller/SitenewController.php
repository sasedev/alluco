<?php
namespace Alluco\AdminBundle\Controller;

use Alluco\DataBundle\Entity\Sitenew;
use Alluco\DataBundle\Entity\SitenewTrans;
use Alluco\AdminBundle\Form\Sitenew\NewTForm as SitenewNewTForm;
use Alluco\AdminBundle\Form\Sitenew\UpdateTForm as SitenewUpdateTForm;
use Alluco\AdminBundle\Form\Sitenew\UpdatePageUrlTForm as SitenewUpdatePageUrlTForm;
use Alluco\AdminBundle\Form\Sitenew\UpdateThumbTForm as SitenewUpdateThumbTForm;
use Alluco\AdminBundle\Form\Sitenew\UpdateThumbInfoTForm as SitenewUpdateThumbInfoTForm;
use Alluco\AdminBundle\Form\SitenewTrans\UpdateTForm as SitenewTransUpdateTForm;
use Alluco\AdminBundle\Form\SitenewTrans\UpdateThumbInfoTForm as SitenewTransUpdateThumbInfoTForm;
use Sasedev\Commons\SharedBundle\Controller\BaseController;

/**
 * @author sasedev <sasedev.bifidis@gmail.com>
 *
 */
class SitenewController extends BaseController
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

        $this->gvars['menu_active'] = 'sitenew';

    }

    public function listAction()
    {
        $em = $this->getEntityManager();
        $sitenews = $em->getRepository('AllucoDataBundle:Sitenew')->getAll();
        $this->gvars['sitenews'] = $sitenews;

        $this->gvars['smenu_active'] = 'list';
        $this->gvars['pagetitle'] = $this->translate('Pagetitle.sitenew.list');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.sitenew.list.txt');
        return $this->renderResponse('AllucoAdminBundle:Sitenew:list.html.twig', $this->gvars);
    }

    public function addGetAction()
    {
        $sitenew = new Sitenew();
        $sitenewNewForm = $this->createForm(new SitenewNewTForm(), $sitenew);
        $this->gvars['sitenew'] = $sitenew;
        $this->gvars['SitenewNewForm'] = $sitenewNewForm->createView();

        $this->gvars['pagetitle'] = $this->translate('Pagetitle.sitenew.add');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.sitenew.add.txt');
        $this->gvars['smenu_active'] = 'add';

        return $this->renderResponse('AllucoAdminBundle:Sitenew:add.html.twig', $this->gvars);
    }

    public function addPostAction()
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            return $this->redirect($this->generateUrl('_admin_sitenew_addGet'));
        }

        $sitenew = new Sitenew();
        $sitenewNewForm = $this->createForm(new SitenewNewTForm(), $sitenew);

        $request = $this->getRequest();
        $reqData = $request->request->all();

        if (isset($reqData['SitenewNewForm'])) {
            $sitenewNewForm->handleRequest($request);
            if ($sitenewNewForm->isValid()) {
                $em = $this->getEntityManager();


                $sitenewUrl = $sitenewNewForm['thumb']->getData();

                if (null != $sitenewUrl) {

                    $sitenewDir = $this->getParameter('kernel.root_dir').'/../web/res/news';

                    $fileName = sha1(uniqid(mt_rand(), true)).'.'.strtolower($sitenewUrl->getClientOriginalExtension());
                    $sitenewUrl->move($sitenewDir, $fileName);

                    $sitenew->setThumb($fileName);
                }

                $em->persist($sitenew);
                $em->flush();

                $langs = $em->getRepository('AllucoDataBundle:Lang')->getAll();
                foreach ($langs as $lang) {
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
                    try {
                        $em->persist($sitenewTrans);
                        $em->flush();
                    } catch (\Exception $e) {
                        // ne rien faire
                    }
                }

                $this->flashMsgSession(
                    'success',
                    $this->translate('Sitenew.add.success', array('%sitenew%' => $sitenew->getPagetitle()))
                );

                return $this->redirect(
                    $this->generateUrl('_admin_sitenew_editGet', array('id' => $sitenew->getId()))
                );
            } else {
                $this->flashMsgSession(
                    'error',
                    $this->translate('Sitenew.add.failure', array('%sitenew%' => $sitenewNewForm['pageTitleFr']->getData()))
                );
            }
        }
        $this->gvars['sitenew'] = $sitenew;
        $this->gvars['SitenewNewForm'] = $sitenewNewForm->createView();

        $this->gvars['pagetitle'] = $this->translate('Pagetitle.sitenew.add');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.sitenew.add.txt');
        $this->gvars['smenu_active'] = 'add';

        return $this->renderResponse('AllucoAdminBundle:Sitenew:add.html.twig', $this->gvars);
    }

    public function deleteAction($id)
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_admin_sitenew_list');
        }
        $em = $this->getEntityManager();
        try {
            $sitenew = $em->getRepository('AllucoDataBundle:Sitenew')->find($id);

            if (null == $sitenew) {
                $this->flashMsgSession('warning', 'Sitenew.delete.notfound');
            } else {
                $em->remove($sitenew);
                $em->flush();

                $this->flashMsgSession(
                    'success',
                    $this->translate('Sitenew.delete.success', array('%sitenew%' => $sitenew->getPagetitle()))
                );
            }
        } catch (\Exception $e) {
            $logger = $this->getLogger();
            $logger->addCritical($e->getLine().' '.$e->getMessage().' '.$e->getTraceAsString());

            $this->flashMsgSession('error', $this->translate('Sitenew.delete.failure'));
        }

        return $this->redirect($urlFrom);

    }

    public function editGetAction($id)
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_admin_sitenew_list');
        }

        $em = $this->getEntityManager();
        try {
            $sitenew = $em->getRepository('AllucoDataBundle:Sitenew')->find($id);

            if (null == $sitenew) {
                $this->flashMsgSession('warning', 'Sitenew.edit.notfound');
            } else {
                $sitenewUpdateForm = $this->createForm(new SitenewUpdateTForm(), $sitenew);
                $sitenewUpdatePageUrlForm = $this->createForm(new SitenewUpdatePageUrlTForm(), $sitenew);
                $sitenewUpdateThumbForm = $this->createForm(new SitenewUpdateThumbTForm(), $sitenew);
                $sitenewUpdateThumbInfoForm = $this->createForm(new SitenewUpdateThumbInfoTForm(), $sitenew);

                $langs = $em->getRepository('AllucoDataBundle:Lang')->getAll();
                $this->gvars['langs'] = $langs;
                foreach ($langs as $lang) {
                    $sitenewTrans = $em->getRepository('AllucoDataBundle:SitenewTrans')->findOneBy(array('lang' => $lang, 'sitenew' => $sitenew));
                    if (null == $sitenewTrans) {
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
                        try {
                            $em->persist($sitenewTrans);
                            $em->flush();
                        } catch (\Exception $e) {
                            // ne rien faire
                        }
                    }
                }

                $em->refresh($sitenew);

                foreach ($sitenew->getI18ns() as $sitenewTrans) {
                    $sitenewTransUpdateForm = $this->createForm(new SitenewTransUpdateTForm($sitenewTrans->getLang()->getLocale()), $sitenewTrans);
                    $sitenewTransUpdateThumbInfoForm = $this->createForm(new SitenewTransUpdateThumbInfoTForm($sitenewTrans->getLang()->getLocale()), $sitenewTrans);
                    $this->gvars['SitenewTransUpdateForm'][$sitenewTrans->getLang()->getLocale()] = $sitenewTransUpdateForm->createView();
                    $this->gvars['SitenewTransUpdateThumbInfoForm'][$sitenewTrans->getLang()->getLocale()] = $sitenewTransUpdateThumbInfoForm->createView();
                }

                $this->gvars['sitenew'] = $sitenew;
                $this->gvars['SitenewUpdateForm'] = $sitenewUpdateForm->createView();
                $this->gvars['SitenewUpdatePageUrlForm'] = $sitenewUpdatePageUrlForm->createView();
                $this->gvars['SitenewUpdateThumbForm'] = $sitenewUpdateThumbForm->createView();
                $this->gvars['SitenewUpdateThumbInfoForm'] = $sitenewUpdateThumbInfoForm->createView();

                $this->gvars['tabActive'] = $this->getSession()->get('tabActive', 1);
                $this->getSession()->remove('tabActive');



                $this->gvars['pagetitle'] = $this->translate('Pagetitle.sitenew.edit', array('%sitenew%' => $sitenew->getPagetitle()));
                $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.sitenew.edit.txt', array('%sitenew%' => $sitenew->getPagetitle()));

                return $this->renderResponse('AllucoAdminBundle:Sitenew:edit.html.twig', $this->gvars);
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
            return $this->redirect($this->generateUrl('_admin_sitenew_list'));
        }

        $em = $this->getEntityManager();
        try {
            $sitenew = $em->getRepository('AllucoDataBundle:Sitenew')->find($id);

            if (null == $sitenew) {
                $this->flashMsgSession('warning', 'Sitenew.edit.notfound');
            } else {
                $sitenewUpdateForm = $this->createForm(new SitenewUpdateTForm(), $sitenew);
                $sitenewUpdatePageUrlForm = $this->createForm(new SitenewUpdatePageUrlTForm(), $sitenew);
                $sitenewUpdateThumbForm = $this->createForm(new SitenewUpdateThumbTForm(), $sitenew);
                $sitenewUpdateThumbInfoForm = $this->createForm(new SitenewUpdateThumbInfoTForm(), $sitenew);

                $langs = $em->getRepository('AllucoDataBundle:Lang')->getAll();
                $this->gvars['langs'] = $langs;
                foreach ($langs as $lang) {
                    $sitenewTrans = $em->getRepository('AllucoDataBundle:SitenewTrans')->findOneBy(array('lang' => $lang, 'sitenew' => $sitenew));
                    if (null == $sitenewTrans) {
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
                        try {
                            $em->persist($sitenewTrans);
                            $em->flush();
                        } catch (\Exception $e) {
                            // ne rien faire
                        }
                    }
                }

                $em->refresh($sitenew);



                $this->gvars['tabActive'] = $this->getSession()->get('tabActive', 2);
                $this->getSession()->remove('tabActive');

                $request = $this->getRequest();
                $reqData = $request->request->all();

                if (isset($reqData['SitenewUpdateForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $sitenewUpdateForm->handleRequest($request);
                    if ($sitenewUpdateForm->isValid()) {
                        $em->persist($sitenew);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('Sitenew.edit.success', array('%sitenew%' => $sitenew->getPagetitle()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($sitenew);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('Sitenew.edit.failure', array('%sitenew%' => $sitenew->getPagetitle()))
                        );
                    }
                } elseif (isset($reqData['SitenewUpdateThumbForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $sitenewUpdateThumbForm->handleRequest($request);
                    if ($sitenewUpdateThumbForm->isValid()) {
                        $sitenewUrl = $sitenewUpdateThumbForm['thumb']->getData();

                        $sitenewDir = $this->getParameter('kernel.root_dir').'/../web/res/news';

                        $fileName = sha1(uniqid(mt_rand(), true)).'.'.strtolower($sitenewUrl->getClientOriginalExtension());
                        $sitenewUrl->move($sitenewDir, $fileName);

                        $sitenew->setThumb($fileName);
                        $em->persist($sitenew);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('Sitenew.edit.success', array('%sitenew%' => $sitenew->getPagetitle()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($sitenew);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('Sitenew.edit.failure', array('%sitenew%' => $sitenew->getPagetitle()))
                        );
                    }
                } elseif (isset($reqData['SitenewUpdateThumbInfoForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $sitenewUpdateThumbInfoForm->handleRequest($request);
                    if ($sitenewUpdateThumbInfoForm->isValid()) {
                        $em->persist($sitenew);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('Sitenew.edit.success', array('%sitenew%' => $sitenew->getPagetitle()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($sitenew);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('Sitenew.edit.failure', array('%sitenew%' => $sitenew->getPagetitle()))
                        );
                    }
                } elseif (isset($reqData['SitenewUpdatePageUrlForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $sitenewUpdatePageUrlForm->handleRequest($request);
                    if ($sitenewUpdatePageUrlForm->isValid()) {
                        $slug = $this->get('cocur_slugify')->slugify($sitenewUpdatePageUrlForm['pageUrl']->getData(), '_');
                        $foundSlug = false;

                        do {
                            $sitenewTest = $em->getRepository('AllucoDataBundle:Sitenew')->findOneBy(array('pageUrl' => $slug));
                            if (null != $sitenewTest && $sitenewTest->getId() != $sitenew->getId()) {
                                $foundSlug = true;
                                $slug = $slug.'_1';
                            } else {
                                $foundSlug = false;
                            }
                        } while ($foundSlug == true);

                        $sitenew->setPageUrl($slug);

                        $em->persist($sitenew);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('Sitenew.edit.success', array('%sitenew%' => $sitenew->getPagetitle()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($sitenew);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('Sitenew.edit.failure', array('%sitenew%' => $sitenew->getPagetitle()))
                        );
                    }
                }



                foreach ($sitenew->getI18ns() as $sitenewTrans) {
                    $em->refresh($sitenewTrans);
                    $sitenewTransUpdateForm = $this->createForm(new SitenewTransUpdateTForm($sitenewTrans->getLang()->getLocale()), $sitenewTrans);
                    $sitenewTransUpdateThumbInfoForm = $this->createForm(new SitenewTransUpdateThumbInfoTForm($sitenewTrans->getLang()->getLocale()), $sitenewTrans);

                    if (isset($reqData['SitenewTransUpdateForm_'.$sitenewTrans->getLang()->getLocale()])) {
                        $this->gvars['tabActive'] = $sitenewTrans->getLang()->getLocale();
                        $this->getSession()->set('tabActive', $sitenewTrans->getLang()->getLocale());
                        $sitenewTransUpdateForm->handleRequest($request);
                        if ($sitenewTransUpdateForm->isValid()) {
                            $em->persist($sitenewTrans);
                            $em->flush();
                            $this->flashMsgSession(
                                'success',
                                $this->translate('SitenewTrans.edit.success', array('%sitenew%' => $sitenew->getPagetitle()))
                            );

                            return $this->redirect($urlFrom);
                        } else {
                            $em->refresh($sitenew);

                            $this->flashMsgSession(
                                'error',
                                $this->translate('SitenewTrans.edit.failure', array('%sitenew%' => $sitenew->getPagetitle()))
                            );
                        }
                    } elseif (isset($reqData['SitenewTransUpdateThumbInfoForm_'.$sitenewTrans->getLang()->getLocale()])) {
                        $this->gvars['tabActive'] = $sitenewTrans->getLang()->getLocale();
                        $this->getSession()->set('tabActive', $sitenewTrans->getLang()->getLocale());
                        $sitenewTransUpdateThumbInfoForm->handleRequest($request);
                        if ($sitenewTransUpdateThumbInfoForm->isValid()) {
                            $em->persist($sitenewTrans);
                            $em->flush();
                            $this->flashMsgSession(
                                'success',
                                $this->translate('SitenewTrans.edit.success', array('%sitenew%' => $sitenew->getPagetitle()))
                            );

                            return $this->redirect($urlFrom);
                        } else {
                            $em->refresh($sitenew);

                            $this->flashMsgSession(
                                'error',
                                $this->translate('SitenewTrans.edit.failure', array('%sitenew%' => $sitenew->getPagetitle()))
                            );
                        }
                    }
                    $this->gvars['SitenewTransUpdateForm'][$sitenewTrans->getLang()->getLocale()] = $sitenewTransUpdateForm->createView();
                    $this->gvars['SitenewTransUpdateThumbInfoForm'][$sitenewTrans->getLang()->getLocale()] = $sitenewTransUpdateThumbInfoForm->createView();
                }

                $this->gvars['sitenew'] = $sitenew;
                $this->gvars['SitenewUpdateForm'] = $sitenewUpdateForm->createView();
                $this->gvars['SitenewUpdatePageUrlForm'] = $sitenewUpdatePageUrlForm->createView();
                $this->gvars['SitenewUpdateThumbForm'] = $sitenewUpdateThumbForm->createView();

                $this->gvars['pagetitle'] = $this->translate('Pagetitle.sitenew.edit', array('%sitenew%' => $sitenew->getPagetitle()));
                $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.sitenew.edit.txt', array('%sitenew%' => $sitenew->getPagetitle()));

                return $this->renderResponse('AllucoAdminBundle:Sitenew:edit.html.twig', $this->gvars);
            }
        } catch (\Exception $e) {
            $logger = $this->getLogger();
            $logger->addCritical($e->getLine().' '.$e->getMessage().' '.$e->getTraceAsString());
        }

        return $this->redirect($urlFrom);

    }
}
