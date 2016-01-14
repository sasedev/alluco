<?php
namespace Alluco\AdminBundle\Controller;

use Alluco\DataBundle\Entity\Staticpage;
use Alluco\AdminBundle\Form\Staticpage\NewTForm as StaticpageNewTForm;
use Alluco\AdminBundle\Form\Staticpage\UpdateTForm as StaticpageUpdateTForm;
use Alluco\AdminBundle\Form\StaticpageTrans\UpdateTForm as StaticpageTransUpdateTForm;
use Sasedev\Commons\SharedBundle\Controller\BaseController;
use Alluco\DataBundle\Entity\StaticpageTrans;

/**
 * @author sasedev <sasedev.bifidis@gmail.com>
 *
 */
class StaticpageController extends BaseController
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

        $this->gvars['menu_active'] = 'staticpage';

    }

    public function listAction()
    {
        $em = $this->getEntityManager();
        $staticpages = $em->getRepository('AllucoDataBundle:Staticpage')->getAll();
        $this->gvars['staticpages'] = $staticpages;

        $this->gvars['smenu_active'] = 'list';
        $this->gvars['pagetitle'] = $this->translate('Pagetitle.staticpage.list');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.staticpage.list.txt');
        return $this->renderResponse('AllucoAdminBundle:Staticpage:list.html.twig', $this->gvars);
    }

    public function addGetAction()
    {
        $staticpage = new Staticpage();
        $staticpageNewForm = $this->createForm(new StaticpageNewTForm(), $staticpage);
        $this->gvars['staticpage'] = $staticpage;
        $this->gvars['StaticpageNewForm'] = $staticpageNewForm->createView();

        $this->gvars['pagetitle'] = $this->translate('Pagetitle.staticpage.add');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.staticpage.add.txt');
        $this->gvars['smenu_active'] = 'add';

        return $this->renderResponse('AllucoAdminBundle:Staticpage:add.html.twig', $this->gvars);
    }

    public function addPostAction()
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            return $this->redirect($this->generateUrl('_admin_staticpage_addGet'));
        }

        $staticpage = new Staticpage();
        $staticpageNewForm = $this->createForm(new StaticpageNewTForm(), $staticpage);

        $request = $this->getRequest();
        $reqData = $request->request->all();

        if (isset($reqData['StaticpageNewForm'])) {
            $staticpageNewForm->handleRequest($request);
            if ($staticpageNewForm->isValid()) {
                $em = $this->getEntityManager();
                $em->persist($staticpage);
                $em->flush();

                $langs = $em->getRepository('AllucoDataBundle:Lang')->getAll();
                foreach ($langs as $lang) {
                    $staticpageTrans = new StaticpageTrans();
                    $staticpageTrans->setLang($lang);
                    $staticpageTrans->setStaticpage($staticpage);
                    $staticpageTrans->setMetaTitle($staticpage->getMetaTitle());
                    $staticpageTrans->setMetaKeywords($staticpage->getMetaKeywords());
                    $staticpageTrans->setMetaDescription($staticpage->getMetaDescription());
                    $staticpageTrans->setPageTitle($staticpage->getPageTitle());
                    $staticpageTrans->setBreadcrumb($staticpage->getBreadcrumb());
                    $staticpageTrans->setPageContent($staticpage->getPageContent());
                    try {
                        $em->persist($staticpageTrans);
                        $em->flush();
                    } catch (\Exception $e) {
                        // ne rien faire
                    }
                }

                $this->flashMsgSession(
                    'success',
                    $this->translate('Staticpage.add.success', array('%staticpage%' => $staticpage->getPagetitle()))
                );

                return $this->redirect(
                    $this->generateUrl('_admin_staticpage_editGet', array('id' => $staticpage->getId()))
                );
            } else {
                $this->flashMsgSession(
                    'error',
                    $this->translate('Staticpage.add.failure', array('%staticpage%' => $staticpageNewForm['name']->getData()))
                );
            }
        }
        $this->gvars['staticpage'] = $staticpage;
        $this->gvars['StaticpageNewForm'] = $staticpageNewForm->createView();

        $this->gvars['pagetitle'] = $this->translate('Pagetitle.staticpage.add');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.staticpage.add.txt');
        $this->gvars['smenu_active'] = 'add';

        return $this->renderResponse('AllucoAdminBundle:Staticpage:add.html.twig', $this->gvars);
    }

    public function deleteAction($id)
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_admin_staticpage_list');
        }
        $em = $this->getEntityManager();
        try {
            $staticpage = $em->getRepository('AllucoDataBundle:Staticpage')->find($id);

            if (null == $staticpage) {
                $this->flashMsgSession('warning', 'Staticpage.delete.notfound');
            } else {
                $em->remove($staticpage);
                $em->flush();

                $this->flashMsgSession(
                    'success',
                    $this->translate('Staticpage.delete.success', array('%staticpage%' => $staticpage->getPagetitle()))
                );
            }
        } catch (\Exception $e) {
            $logger = $this->getLogger();
            $logger->addCritical($e->getLine().' '.$e->getMessage().' '.$e->getTraceAsString());

            $this->flashMsgSession('error', $this->translate('Staticpage.delete.failure'));
        }

        return $this->redirect($urlFrom);

    }

    public function editGetAction($id)
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_admin_staticpage_list');
        }

        $em = $this->getEntityManager();
        try {
            $staticpage = $em->getRepository('AllucoDataBundle:Staticpage')->find($id);

            if (null == $staticpage) {
                $this->flashMsgSession('warning', 'Staticpage.edit.notfound');
            } else {
                $staticpageUpdateForm = $this->createForm(new StaticpageUpdateTForm(), $staticpage);

                $langs = $em->getRepository('AllucoDataBundle:Lang')->getAll();
                $this->gvars['langs'] = $langs;
                foreach ($langs as $lang) {
                    $staticpageTrans = $em->getRepository('AllucoDataBundle:StaticpageTrans')->findOneBy(array('lang' => $lang, 'staticpage' => $staticpage));
                    if (null == $staticpageTrans) {
                        $staticpageTrans = new StaticpageTrans();
                        $staticpageTrans->setLang($lang);
                        $staticpageTrans->setStaticpage($staticpage);
                        $staticpageTrans->setMetaTitle($staticpage->getMetaTitle());
                        $staticpageTrans->setMetaKeywords($staticpage->getMetaKeywords());
                        $staticpageTrans->setMetaDescription($staticpage->getMetaDescription());
                        $staticpageTrans->setPageTitle($staticpage->getPageTitle());
                        $staticpageTrans->setBreadcrumb($staticpage->getBreadcrumb());
                        $staticpageTrans->setPageContent($staticpage->getPageContent());
                        try {
                            $em->persist($staticpageTrans);
                            $em->flush();
                        } catch (\Exception $e) {
                            // ne rien faire
                        }
                    }
                }

                $em->refresh($staticpage);

                foreach ($staticpage->getI18ns() as $staticpageTrans) {
                    $staticpageTransUpdateForm = $this->createForm(new StaticpageTransUpdateTForm($staticpageTrans->getLang()->getLocale()), $staticpageTrans);
                    $this->gvars['StaticpageTransUpdateForm'][$staticpageTrans->getLang()->getLocale()] = $staticpageTransUpdateForm->createView();
                }

                $this->gvars['staticpage'] = $staticpage;
                $this->gvars['StaticpageUpdateForm'] = $staticpageUpdateForm->createView();

                $this->gvars['tabActive'] = $this->getSession()->get('tabActive', 1);
                $this->getSession()->remove('tabActive');



                $this->gvars['pagetitle'] = $this->translate('Pagetitle.staticpage.edit', array('%staticpage%' => $staticpage->getPagetitle()));
                $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.staticpage.edit.txt', array('%staticpage%' => $staticpage->getPagetitle()));

                return $this->renderResponse('AllucoAdminBundle:Staticpage:edit.html.twig', $this->gvars);
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
            return $this->redirect($this->generateUrl('_admin_staticpage_list'));
        }

        $em = $this->getEntityManager();
        try {
            $staticpage = $em->getRepository('AllucoDataBundle:Staticpage')->find($id);

            if (null == $staticpage) {
                $this->flashMsgSession('warning', 'Staticpage.edit.notfound');
            } else {
                $staticpageUpdateForm = $this->createForm(new StaticpageUpdateTForm(), $staticpage);

                $langs = $em->getRepository('AllucoDataBundle:Lang')->getAll();
                $this->gvars['langs'] = $langs;
                foreach ($langs as $lang) {
                    $staticpageTrans = $em->getRepository('AllucoDataBundle:StaticpageTrans')->findOneBy(array('lang' => $lang, 'staticpage' => $staticpage));
                    if (null == $staticpageTrans) {
                        $staticpageTrans = new StaticpageTrans();
                        $staticpageTrans->setLang($lang);
                        $staticpageTrans->setStaticpage($staticpage);
                        $staticpageTrans->setMetaKeywords($staticpage->getMetaKeywords());
                        $staticpageTrans->setMetaDescription($staticpage->getMetaDescription());
                        $staticpageTrans->setPageTitle($staticpage->getPageTitle());
                        $staticpageTrans->setBreadcrumb($staticpage->getBreadcrumb());
                        $staticpageTrans->setPageContent($staticpage->getPageContent());
                        try {
                            $em->persist($staticpageTrans);
                            $em->flush();
                        } catch (\Exception $e) {
                            // ne rien faire
                        }
                    }
                }

                $em->refresh($staticpage);





                $this->gvars['tabActive'] = $this->getSession()->get('tabActive', 2);
                $this->getSession()->remove('tabActive');

                $request = $this->getRequest();
                $reqData = $request->request->all();

                if (isset($reqData['StaticpageUpdateForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $staticpageUpdateForm->handleRequest($request);
                    if ($staticpageUpdateForm->isValid()) {
                        $em->persist($staticpage);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('Staticpage.edit.success', array('%staticpage%' => $staticpage->getPagetitle()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($staticpage);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('Staticpage.edit.failure', array('%staticpage%' => $staticpage->getPagetitle()))
                        );
                    }
                }

                foreach ($staticpage->getI18ns() as $staticpageTrans) {
                    $em->refresh($staticpageTrans);
                    $staticpageTransUpdateForm = $this->createForm(new StaticpageTransUpdateTForm($staticpageTrans->getLang()->getLocale()), $staticpageTrans);
                    if (isset($reqData['StaticpageTransUpdateForm_'.$staticpageTrans->getLang()->getLocale()])) {
                        $this->gvars['tabActive'] = $staticpageTrans->getLang()->getLocale();
                        $this->getSession()->set('tabActive', $staticpageTrans->getLang()->getLocale());
                        $staticpageTransUpdateForm->handleRequest($request);
                        if ($staticpageTransUpdateForm->isValid()) {
                            $em->persist($staticpageTrans);
                            $em->flush();
                            $this->flashMsgSession(
                                'success',
                                $this->translate('StaticpageTrans.edit.success', array('%staticpage%' => $staticpage->getPagetitle()))
                            );

                            return $this->redirect($urlFrom);
                        } else {
                            $em->refresh($staticpage);

                            $this->flashMsgSession(
                                'error',
                                $this->translate('StaticpageTrans.edit.failure', array('%staticpage%' => $staticpage->getPagetitle()))
                            );
                        }
                    }
                    $this->gvars['StaticpageTransUpdateForm'][$staticpageTrans->getLang()->getLocale()] = $staticpageTransUpdateForm->createView();
                }

                $this->gvars['staticpage'] = $staticpage;
                $this->gvars['StaticpageUpdateForm'] = $staticpageUpdateForm->createView();

                $this->gvars['pagetitle'] = $this->translate('Pagetitle.staticpage.edit', array('%staticpage%' => $staticpage->getPagetitle()));
                $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.staticpage.edit.txt', array('%staticpage%' => $staticpage->getPagetitle()));

                return $this->renderResponse('AllucoAdminBundle:Staticpage:edit.html.twig', $this->gvars);
            }
        } catch (\Exception $e) {
            $logger = $this->getLogger();
            $logger->addCritical($e->getLine().' '.$e->getMessage().' '.$e->getTraceAsString());
        }

        return $this->redirect($urlFrom);

    }
}
