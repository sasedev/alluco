<?php
namespace Alluco\AdminBundle\Controller;

use Alluco\DataBundle\Entity\Productpic;
use Alluco\AdminBundle\Form\Productpic\NewTForm as ProductpicNewTForm;
use Alluco\AdminBundle\Form\Productpic\UpdateContentTForm as ProductpicUpdateContentTForm;
use Alluco\AdminBundle\Form\Productpic\UpdateInfoTForm as ProductpicUpdateInfoTForm;
use Alluco\AdminBundle\Form\Productpic\UpdateRankTForm as ProductpicUpdateRankTForm;
use Alluco\AdminBundle\Form\ProductpicTrans\UpdateInfoTForm as ProductpicTransUpdateInfoTForm;
use Sasedev\Commons\SharedBundle\Controller\BaseController;
use Alluco\DataBundle\Entity\ProductpicTrans;

/**
 * @author sasedev <sasedev.bifidis@gmail.com>
 *
 */
class ProductpicController extends BaseController
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

        $this->gvars['menu_active'] = 'productpic';

    }

    public function listAction()
    {
        $em = $this->getEntityManager();
        $productpics = $em->getRepository('AllucoDataBundle:Productpic')->getAll();
        $this->gvars['productpics'] = $productpics;

        $this->gvars['smenu_active'] = 'list';
        $this->gvars['pagetitle'] = $this->translate('Pagetitle.productpic.list');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.productpic.list.txt');
        return $this->renderResponse('AllucoAdminBundle:Productpic:list.html.twig', $this->gvars);
    }

    public function addGetAction()
    {
        $productpic = new Productpic();
        $productpicNewForm = $this->createForm(new ProductpicNewTForm(), $productpic);
        $this->gvars['ProductpicNewForm'] = $productpicNewForm->createView();

        $this->gvars['pagetitle'] = $this->translate('Pagetitle.productpic.add');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.productpic.add.txt');
        $this->gvars['smenu_active'] = 'add';

        return $this->renderResponse('AllucoAdminBundle:Productpic:add.html.twig', $this->gvars);
    }

    public function addPostAction()
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            return $this->redirect($this->generateUrl('_admin_productpic_addGet'));
        }

        $productpic = new Productpic();
        $productpicNewForm = $this->createForm(new ProductpicNewTForm(), $productpic);
        $this->gvars['ProductpicNewForm'] = $productpicNewForm->createView();

        $request = $this->getRequest();
        $reqData = $request->request->all();

        if (isset($reqData['ProductpicNewForm'])) {
            $productpicNewForm->handleRequest($request);
            if ($productpicNewForm->isValid()) {
                $em = $this->getEntityManager();
                $productpicUrl = $productpicNewForm['filename']->getData();

                $productpicDir = $this->getParameter('kernel.root_dir').'/../web/res/pics';

                $fileName = sha1(uniqid(mt_rand(), true)).'.'.strtolower($productpicUrl->getClientOriginalExtension());
                $productpicUrl->move($productpicDir, $fileName);

                $productpic->setFilename($fileName);
                $em->persist($productpic);
                $em->flush();

                $langs = $em->getRepository('AllucoDataBundle:Lang')->getAll();
                foreach ($langs as $lang) {
                    $productpicTrans = new ProductpicTrans();
                    $productpicTrans->setLang($lang);
                    $productpicTrans->setProductpic($productpic);
                    $productpicTrans->setAlt($productpic->getAlt());
                    $productpicTrans->setTitle($productpic->getTitle());
                    try {
                        $em->persist($productpicTrans);
                        $em->flush();
                    } catch (\Exception $e) {
                        // ne rien faire
                    }
                }
                $this->flashMsgSession(
                    'success',
                    $this->translate('Productpic.add.success', array('%productpic%' => $productpic->getFilename()))
                );

                return $this->redirect(
                    $this->generateUrl('_admin_productpic_editGet', array('id' => $productpic->getId()))
                );
            } else {
                $this->flashMsgSession(
                    'error',
                    $this->translate('Productpic.add.failure', array('%productpic%' => $productpicNewForm['alt']->getData()))
                );
            }
        }

        $this->gvars['pagetitle'] = $this->translate('Pagetitle.productpic.add');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.productpic.add.txt');
        $this->gvars['smenu_active'] = 'add';

        return $this->renderResponse('AllucoAdminBundle:Productpic:add.html.twig', $this->gvars);
    }

    public function deleteAction($id)
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_admin_productpic_list');
        }
        $em = $this->getEntityManager();
        try {
            $productpic = $em->getRepository('AllucoDataBundle:Productpic')->find($id);

            if (null == $productpic) {
                $this->flashMsgSession('warning', 'Productpic.delete.notfound');
            } else {
                $em->remove($productpic);
                $em->flush();

                $this->flashMsgSession(
                    'success',
                    $this->translate('Productpic.delete.success', array('%productpic%' => $productpic->getFilename()))
                );
            }
        } catch (\Exception $e) {
            $logger = $this->getLogger();
            $logger->addCritical($e->getLine().' '.$e->getMessage().' '.$e->getTraceAsString());

            $this->flashMsgSession('error', $this->translate('Productpic.delete.failure'));
        }

        return $this->redirect($urlFrom);

    }

    public function editGetAction($id)
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_admin_productpic_list');
        }

        $em = $this->getEntityManager();
        try {
            $productpic = $em->getRepository('AllucoDataBundle:Productpic')->find($id);

            if (null == $productpic) {
                $this->flashMsgSession('warning', 'Productpic.edit.notfound');
            } else {
                $productpicUpdateContentForm = $this->createForm(new ProductpicUpdateContentTForm(), $productpic);
                $productpicUpdateRankForm = $this->createForm(new ProductpicUpdateRankTForm(), $productpic);
                $productpicUpdateInfoForm = $this->createForm(new ProductpicUpdateInfoTForm(), $productpic);

                $langs = $em->getRepository('AllucoDataBundle:Lang')->getAll();
                $this->gvars['langs'] = $langs;
                foreach ($langs as $lang) {
                    $productpicTrans = $em->getRepository('AllucoDataBundle:ProductpicTrans')->findOneBy(array('lang' => $lang, 'productpic' => $productpic));
                    if (null == $productpicTrans) {
                        $productpicTrans = new ProductpicTrans();
                        $productpicTrans->setProductpic($productpic);
                        $productpicTrans->setLang($lang);
                        $productpicTrans->setAlt($productpic->getAlt());
                        $productpicTrans->setTitle($productpic->getTitle());
                        try {
                            $em->persist($productpicTrans);
                            $em->flush();
                        } catch (\Exception $e) {
                            // ne rien faire
                        }
                    }
                }

                $em->refresh($productpic);


                foreach ($productpic->getI18ns() as $productpicTrans) {
                    $productpicTransUpdateInfoForm = $this->createForm(new ProductpicTransUpdateInfoTForm($productpicTrans->getLang()->getLocale()), $productpicTrans);
                    $this->gvars['ProductpicTransUpdateInfoForm'][$productpicTrans->getLang()->getLocale()] = $productpicTransUpdateInfoForm->createView();
                }

                $this->gvars['productpic'] = $productpic;
                $this->gvars['ProductpicUpdateContentForm'] = $productpicUpdateContentForm->createView();
                $this->gvars['ProductpicUpdateRankForm'] = $productpicUpdateRankForm->createView();
                $this->gvars['ProductpicUpdateInfoForm'] = $productpicUpdateInfoForm->createView();

                $this->gvars['tabActive'] = $this->getSession()->get('tabActive', 1);
                $this->getSession()->remove('tabActive');



                $this->gvars['pagetitle'] = $this->translate('Pagetitle.productpic.edit', array('%productpic%' => $productpic->getFilename()));
                $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.productpic.edit.txt', array('%productpic%' => $productpic->getFilename()));

                return $this->renderResponse('AllucoAdminBundle:Productpic:edit.html.twig', $this->gvars);
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
            return $this->redirect($this->generateUrl('_admin_productpic_list'));
        }

        $em = $this->getEntityManager();
        try {
            $productpic = $em->getRepository('AllucoDataBundle:Productpic')->find($id);

            if (null == $productpic) {
                $this->flashMsgSession('warning', 'Productpic.edit.notfound');
            } else {
                $productpicUpdateContentForm = $this->createForm(new ProductpicUpdateContentTForm(), $productpic);
                $productpicUpdateRankForm = $this->createForm(new ProductpicUpdateRankTForm(), $productpic);
                $productpicUpdateInfoForm = $this->createForm(new ProductpicUpdateInfoTForm(), $productpic);

                $langs = $em->getRepository('AllucoDataBundle:Lang')->getAll();
                $this->gvars['langs'] = $langs;
                foreach ($langs as $lang) {
                    $productpicTrans = $em->getRepository('AllucoDataBundle:ProductpicTrans')->findOneBy(array('lang' => $lang, 'productpic' => $productpic));
                    if (null == $productpicTrans) {
                        $productpicTrans = new ProductpicTrans();
                        $productpicTrans->setProductpic($productpic);
                        $productpicTrans->setLang($lang);
                        $productpicTrans->setAlt($productpic->getAlt());
                        $productpicTrans->setTitle($productpic->getTitle());
                        try {
                            $em->persist($productpicTrans);
                            $em->flush();
                        } catch (\Exception $e) {
                            // ne rien faire
                        }
                    }
                }

                $em->refresh($productpic);



                $this->gvars['tabActive'] = $this->getSession()->get('tabActive', 2);
                $this->getSession()->remove('tabActive');

                $request = $this->getRequest();
                $reqData = $request->request->all();

                if (isset($reqData['ProductpicUpdateContentForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $productpicUpdateContentForm->handleRequest($request);
                    if ($productpicUpdateContentForm->isValid()) {

                        $productpicUrl = $productpicUpdateContentForm['filename']->getData();

                        $productpicDir = $this->getParameter('kernel.root_dir').'/../web/res/pics';

                        $fileName = sha1(uniqid(mt_rand(), true)).'.'.strtolower($productpicUrl->getClientOriginalExtension());
                        $productpicUrl->move($productpicDir, $fileName);

                        $productpic->setFilename($fileName);
                        $em->persist($productpic);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('Productpic.edit.success', array('%productpic%' => $productpic->getFilename()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($productpic);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('Productpic.edit.failure', array('%productpic%' => $productpic->getFilename()))
                        );
                    }
                } elseif (isset($reqData['ProductpicUpdateRankForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $productpicUpdateRankForm->handleRequest($request);
                    if ($productpicUpdateRankForm->isValid()) {
                        $em->persist($productpic);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('Productpic.edit.success', array('%productpic%' => $productpic->getFilename()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($productpic);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('Productpic.edit.failure', array('%productpic%' => $productpic->getFilename()))
                        );
                    }
                } elseif (isset($reqData['ProductpicUpdateInfoForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $productpicUpdateInfoForm->handleRequest($request);
                    if ($productpicUpdateInfoForm->isValid()) {
                        $em->persist($productpic);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('Productpic.edit.success', array('%productpic%' => $productpic->getFilename()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($productpic);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('Productpic.edit.failure', array('%productpic%' => $productpic->getFilename()))
                        );
                    }
                }

                foreach ($productpic->getI18ns() as $productpicTrans) {
                    $em->refresh($productpicTrans);
                    $productpicTransUpdateInfoForm = $this->createForm(new ProductpicTransUpdateInfoTForm($productpicTrans->getLang()->getLocale()), $productpicTrans);
                    if (isset($reqData['ProductpicTransUpdateInfoForm_'.$productpicTrans->getLang()->getLocale()])) {
                        $this->gvars['tabActive'] = $productpicTrans->getLang()->getLocale();
                        $this->getSession()->set('tabActive', $productpicTrans->getLang()->getLocale());
                        $productpicTransUpdateInfoForm->handleRequest($request);
                        if ($productpicTransUpdateInfoForm->isValid()) {
                            $em->persist($productpicTrans);
                            $em->flush();
                            $this->flashMsgSession(
                                'success',
                                $this->translate('ProductpicTrans.edit.success', array('%productpic%' => $productpic->getFilename()))
                            );

                            return $this->redirect($urlFrom);
                        } else {
                            $em->refresh($productpic);

                            $this->flashMsgSession(
                                'error',
                                $this->translate('ProductpicTrans.edit.failure', array('%productpic%' => $productpic->getFilename()))
                            );
                        }
                    }
                    $this->gvars['ProductpicTransUpdateInfoForm'][$productpicTrans->getLang()->getLocale()] = $productpicTransUpdateInfoForm->createView();
                }

                $this->gvars['productpic'] = $productpic;
                $this->gvars['ProductpicUpdateContentForm'] = $productpicUpdateContentForm->createView();
                $this->gvars['ProductpicUpdateRankForm'] = $productpicUpdateRankForm->createView();
                $this->gvars['ProductpicUpdateInfoForm'] = $productpicUpdateInfoForm->createView();

                $this->gvars['pagetitle'] = $this->translate('Pagetitle.productpic.edit', array('%productpic%' => $productpic->getFilename()));
                $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.productpic.edit.txt', array('%productpic%' => $productpic->getFilename()));

                return $this->renderResponse('AllucoAdminBundle:Productpic:edit.html.twig', $this->gvars);
            }
        } catch (\Exception $e) {
            $logger = $this->getLogger();
            $logger->addCritical($e->getLine().' '.$e->getMessage().' '.$e->getTraceAsString());
        }

        return $this->redirect($urlFrom);

    }
}
