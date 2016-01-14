<?php
namespace Alluco\AdminBundle\Controller;

use Alluco\DataBundle\Entity\Productdoc;
use Alluco\AdminBundle\Form\Productdoc\NewTForm as ProductdocNewTForm;
use Alluco\AdminBundle\Form\Productdoc\UpdateContentTForm as ProductdocUpdateContentTForm;
use Alluco\AdminBundle\Form\Productdoc\UpdateInfoTForm as ProductdocUpdateInfoTForm;
use Alluco\AdminBundle\Form\Productdoc\UpdateRankTForm as ProductdocUpdateRankTForm;
use Alluco\AdminBundle\Form\Productdoc\UpdateOriginalNameTForm as ProductdocUpdateOriginalNameTForm;
use Alluco\AdminBundle\Form\ProductdocTrans\UpdateInfoTForm as ProductdocTransUpdateInfoTForm;
use Sasedev\Commons\SharedBundle\Controller\BaseController;
use Alluco\DataBundle\Entity\ProductdocTrans;

/**
 * @author sasedev <sasedev.bifidis@gmail.com>
 *
 */
class ProductdocController extends BaseController
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

        $this->gvars['menu_active'] = 'productdoc';

    }

    public function listAction()
    {
        $em = $this->getEntityManager();
        $productdocs = $em->getRepository('AllucoDataBundle:Productdoc')->getAll();
        $this->gvars['productdocs'] = $productdocs;

        $this->gvars['smenu_active'] = 'list';
        $this->gvars['pagetitle'] = $this->translate('Pagetitle.productdoc.list');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.productdoc.list.txt');
        return $this->renderResponse('AllucoAdminBundle:Productdoc:list.html.twig', $this->gvars);
    }

    public function addGetAction()
    {
        $productdoc = new Productdoc();
        $productdocNewForm = $this->createForm(new ProductdocNewTForm(), $productdoc);
        $this->gvars['ProductdocNewForm'] = $productdocNewForm->createView();

        $this->gvars['pagetitle'] = $this->translate('Pagetitle.productdoc.add');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.productdoc.add.txt');
        $this->gvars['smenu_active'] = 'add';

        return $this->renderResponse('AllucoAdminBundle:Productdoc:add.html.twig', $this->gvars);
    }

    public function addPostAction()
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            return $this->redirect($this->generateUrl('_admin_productdoc_addGet'));
        }

        $productdoc = new Productdoc();
        $productdocNewForm = $this->createForm(new ProductdocNewTForm(), $productdoc);
        $this->gvars['ProductdocNewForm'] = $productdocNewForm->createView();

        $request = $this->getRequest();
        $reqData = $request->request->all();

        if (isset($reqData['ProductdocNewForm'])) {
            $productdocNewForm->handleRequest($request);
            if ($productdocNewForm->isValid()) {
                $em = $this->getEntityManager();
                $productdocUrl = $productdocNewForm['filename']->getData();

                $productdocDir = $this->getParameter('kernel.root_dir').'/../web/res/docs';

                $originalName = $productdocUrl->getClientOriginalName();
                $fileName = sha1(uniqid(mt_rand(), true)).'.'.strtolower($productdocUrl->getClientOriginalExtension());
                $mimeType = $productdocUrl->getMimeType();
                $productdocUrl->move($productdocDir, $fileName);

                $size = filesize($productdocDir.'/'.$fileName);
                $md5 = md5_file($productdocDir.'/'.$fileName);

                $productdoc->setFilename($fileName);

                $productdoc->setOriginalName($originalName);
                $productdoc->setSize($size);
                $productdoc->setMimeType($mimeType);
                $productdoc->setMd5($md5);

                $em->persist($productdoc);
                $em->flush();

                $langs = $em->getRepository('AllucoDataBundle:Lang')->getAll();
                foreach ($langs as $lang) {
                    $productdocTrans = new ProductdocTrans();
                    $productdocTrans->setLang($lang);
                    $productdocTrans->setProductdoc($productdoc);
                    $productdocTrans->setTitle($productdoc->getTitle());
                    try {
                        $em->persist($productdocTrans);
                        $em->flush();
                    } catch (\Exception $ex) {
                        // ne rien faire
                    }
                }

                $this->flashMsgSession(
                    'success',
                    $this->translate('Productdoc.add.success', array('%productdoc%' => $productdoc->getFilename()))
                );

                return $this->redirect(
                    $this->generateUrl('_admin_productdoc_editGet', array('id' => $productdoc->getId()))
                );
            } else {
                $this->flashMsgSession(
                    'error',
                    $this->translate('Productdoc.add.failure', array('%productdoc%' => $productdocNewForm['title']->getData()))
                );
            }
        }

        $this->gvars['pagetitle'] = $this->translate('Pagetitle.productdoc.add');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.productdoc.add.txt');
        $this->gvars['smenu_active'] = 'add';

        return $this->renderResponse('AllucoAdminBundle:Productdoc:add.html.twig', $this->gvars);
    }

    public function deleteAction($id)
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_admin_productdoc_list');
        }
        $em = $this->getEntityManager();
        try {
            $productdoc = $em->getRepository('AllucoDataBundle:Productdoc')->find($id);

            if (null == $productdoc) {
                $this->flashMsgSession('warning', 'Productdoc.delete.notfound');
            } else {
                $em->remove($productdoc);
                $em->flush();

                $this->flashMsgSession(
                    'success',
                    $this->translate('Productdoc.delete.success', array('%productdoc%' => $productdoc->getFilename()))
                );
            }
        } catch (\Exception $e) {
            $logger = $this->getLogger();
            $logger->addCritical($e->getLine().' '.$e->getMessage().' '.$e->getTraceAsString());

            $this->flashMsgSession('error', $this->translate('Productdoc.delete.failure'));
        }

        return $this->redirect($urlFrom);

    }

    public function editGetAction($id)
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_admin_productdoc_list');
        }

        $em = $this->getEntityManager();
        try {
            $productdoc = $em->getRepository('AllucoDataBundle:Productdoc')->find($id);

            if (null == $productdoc) {
                $this->flashMsgSession('warning', 'Productdoc.edit.notfound');
            } else {
                $productdocUpdateContentForm = $this->createForm(new ProductdocUpdateContentTForm(), $productdoc);
                $productdocUpdateRankForm = $this->createForm(new ProductdocUpdateRankTForm(), $productdoc);
                $productdocUpdateInfoForm = $this->createForm(new ProductdocUpdateInfoTForm(), $productdoc);
                $productdocUpdateOriginalNameForm = $this->createForm(new ProductdocUpdateOriginalNameTForm(), $productdoc);

                $langs = $em->getRepository('AllucoDataBundle:Lang')->getAll();
                $this->gvars['langs'] = $langs;
                foreach ($langs as $lang) {
                    $productdocTrans = $em->getRepository('AllucoDataBundle:ProductdocTrans')->findOneBy(array('lang' => $lang, 'productdoc' => $productdoc));
                    if (null == $productdocTrans) {
                        $productdocTrans = new ProductdocTrans();
                        $productdocTrans->setProductdoc($productdoc);
                        $productdocTrans->setLang($lang);
                        $productdocTrans->setTitle($productdoc->getTitle());
                        try {
                            $em->persist($productdocTrans);
                            $em->flush();
                        } catch (\Exception $e) {
                            // ne rien faire
                        }
                    }
                }

                $em->refresh($productdoc);


                foreach ($productdoc->getI18ns() as $productdocTrans) {
                    $productdocTransUpdateInfoForm = $this->createForm(new ProductdocTransUpdateInfoTForm($productdocTrans->getLang()->getLocale()), $productdocTrans);
                    $this->gvars['ProductdocTransUpdateInfoForm'][$productdocTrans->getLang()->getLocale()] = $productdocTransUpdateInfoForm->createView();
                }

                $this->gvars['productdoc'] = $productdoc;
                $this->gvars['ProductdocUpdateContentForm'] = $productdocUpdateContentForm->createView();
                $this->gvars['ProductdocUpdateRankForm'] = $productdocUpdateRankForm->createView();
                $this->gvars['ProductdocUpdateInfoForm'] = $productdocUpdateInfoForm->createView();
                $this->gvars['ProductdocUpdateOriginalNameForm'] = $productdocUpdateOriginalNameForm->createView();

                $this->gvars['tabActive'] = $this->getSession()->get('tabActive', 1);
                $this->getSession()->remove('tabActive');



                $this->gvars['pagetitle'] = $this->translate('Pagetitle.productdoc.edit', array('%productdoc%' => $productdoc->getFilename()));
                $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.productdoc.edit.txt', array('%productdoc%' => $productdoc->getFilename()));

                return $this->renderResponse('AllucoAdminBundle:Productdoc:edit.html.twig', $this->gvars);
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
            return $this->redirect($this->generateUrl('_admin_productdoc_list'));
        }

        $em = $this->getEntityManager();
        try {
            $productdoc = $em->getRepository('AllucoDataBundle:Productdoc')->find($id);

            if (null == $productdoc) {
                $this->flashMsgSession('warning', 'Productdoc.edit.notfound');
            } else {
                $productdocUpdateContentForm = $this->createForm(new ProductdocUpdateContentTForm(), $productdoc);
                $productdocUpdateRankForm = $this->createForm(new ProductdocUpdateRankTForm(), $productdoc);
                $productdocUpdateInfoForm = $this->createForm(new ProductdocUpdateInfoTForm(), $productdoc);
                $productdocUpdateOriginalNameForm = $this->createForm(new ProductdocUpdateOriginalNameTForm(), $productdoc);

                $langs = $em->getRepository('AllucoDataBundle:Lang')->getAll();
                $this->gvars['langs'] = $langs;
                foreach ($langs as $lang) {
                    $productdocTrans = $em->getRepository('AllucoDataBundle:ProductdocTrans')->findOneBy(array('lang' => $lang, 'productdoc' => $productdoc));
                    if (null == $productdocTrans) {
                        $productdocTrans = new ProductdocTrans();
                        $productdocTrans->setProductdoc($productdoc);
                        $productdocTrans->setLang($lang);
                        $productdocTrans->setAlt($productdoc->getAlt());
                        $productdocTrans->setTitle($productdoc->getTitle());
                        try {
                            $em->persist($productdocTrans);
                            $em->flush();
                        } catch (\Exception $e) {
                            // ne rien faire
                        }
                    }
                }

                $em->refresh($productdoc);



                $this->gvars['tabActive'] = $this->getSession()->get('tabActive', 2);
                $this->getSession()->remove('tabActive');

                $request = $this->getRequest();
                $reqData = $request->request->all();

                if (isset($reqData['ProductdocUpdateContentForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $productdocUpdateContentForm->handleRequest($request);
                    if ($productdocUpdateContentForm->isValid()) {

                        $productdocUrl = $productdocUpdateContentForm['filename']->getData();

                        $productdocDir = $this->getParameter('kernel.root_dir').'/../web/res/docs';

                        $originalName = $productdocUrl->getClientOriginalName();
                        $fileName = sha1(uniqid(mt_rand(), true)).'.'.strtolower($productdocUrl->getClientOriginalExtension());
                        $mimeType = $productdocUrl->getMimeType();
                        $productdocUrl->move($productdocDir, $fileName);

                        $size = filesize($productdocDir.'/'.$fileName);
                        $md5 = md5_file($productdocDir.'/'.$fileName);

                        $productdoc->setFilename($fileName);

                        $productdoc->setOriginalName($originalName);
                        $productdoc->setSize($size);
                        $productdoc->setMimeType($mimeType);
                        $productdoc->setMd5($md5);
                        $em->persist($productdoc);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('Productdoc.edit.success', array('%productdoc%' => $productdoc->getFilename()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($productdoc);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('Productdoc.edit.failure', array('%productdoc%' => $productdoc->getFilename()))
                        );
                    }
                } elseif (isset($reqData['ProductdocUpdateRankForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $productdocUpdateRankForm->handleRequest($request);
                    if ($productdocUpdateRankForm->isValid()) {
                        $em->persist($productdoc);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('Productdoc.edit.success', array('%productdoc%' => $productdoc->getFilename()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($productdoc);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('Productdoc.edit.failure', array('%productdoc%' => $productdoc->getFilename()))
                        );
                    }
                } elseif (isset($reqData['ProductdocUpdateInfoForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $productdocUpdateInfoForm->handleRequest($request);
                    if ($productdocUpdateInfoForm->isValid()) {
                        $em->persist($productdoc);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('Productdoc.edit.success', array('%productdoc%' => $productdoc->getFilename()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($productdoc);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('Productdoc.edit.failure', array('%productdoc%' => $productdoc->getFilename()))
                        );
                    }
                } elseif (isset($reqData['ProductdocUpdateOriginalNameForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $productdocUpdateOriginalNameForm->handleRequest($request);
                    if ($productdocUpdateOriginalNameForm->isValid()) {
                        $em->persist($productdoc);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('Productdoc.edit.success', array('%productdoc%' => $productdoc->getFilename()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($productdoc);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('Productdoc.edit.failure', array('%productdoc%' => $productdoc->getFilename()))
                        );
                    }
                }

                foreach ($productdoc->getI18ns() as $productdocTrans) {
                    $em->refresh($productdocTrans);
                    $productdocTransUpdateInfoForm = $this->createForm(new ProductdocTransUpdateInfoTForm($productdocTrans->getLang()->getLocale()), $productdocTrans);
                    if (isset($reqData['ProductdocTransUpdateInfoForm_'.$productdocTrans->getLang()->getLocale()])) {
                        $this->gvars['tabActive'] = $productdocTrans->getLang()->getLocale();
                        $this->getSession()->set('tabActive', $productdocTrans->getLang()->getLocale());
                        $productdocTransUpdateInfoForm->handleRequest($request);
                        if ($productdocTransUpdateInfoForm->isValid()) {
                            $em->persist($productdocTrans);
                            $em->flush();
                            $this->flashMsgSession(
                                'success',
                                $this->translate('ProductdocTrans.edit.success', array('%productdoc%' => $productdoc->getFilename()))
                            );

                            return $this->redirect($urlFrom);
                        } else {
                            $em->refresh($productdoc);

                            $this->flashMsgSession(
                                'error',
                                $this->translate('ProductdocTrans.edit.failure', array('%productdoc%' => $productdoc->getFilename()))
                            );
                        }
                    }
                    $this->gvars['ProductdocTransUpdateInfoForm'][$productdocTrans->getLang()->getLocale()] = $productdocTransUpdateInfoForm->createView();
                }

                $this->gvars['productdoc'] = $productdoc;
                $this->gvars['ProductdocUpdateContentForm'] = $productdocUpdateContentForm->createView();
                $this->gvars['ProductdocUpdateRankForm'] = $productdocUpdateRankForm->createView();
                $this->gvars['ProductdocUpdateInfoForm'] = $productdocUpdateInfoForm->createView();
                $this->gvars['ProductdocUpdateOriginalNameForm'] = $productdocUpdateOriginalNameForm->createView();

                $this->gvars['pagetitle'] = $this->translate('Pagetitle.productdoc.edit', array('%productdoc%' => $productdoc->getFilename()));
                $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.productdoc.edit.txt', array('%productdoc%' => $productdoc->getFilename()));

                return $this->renderResponse('AllucoAdminBundle:Productdoc:edit.html.twig', $this->gvars);
            }
        } catch (\Exception $e) {
            $logger = $this->getLogger();
            $logger->addCritical($e->getLine().' '.$e->getMessage().' '.$e->getTraceAsString());
        }

        return $this->redirect($urlFrom);

    }
}
