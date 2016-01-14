<?php
namespace Alluco\AdminBundle\Controller;

use Alluco\DataBundle\Entity\Product;
use Alluco\AdminBundle\Form\Product\NewTForm as ProductNewTForm;
use Alluco\AdminBundle\Form\Product\UpdateNameTForm as ProductUpdateNameTForm;
use Alluco\AdminBundle\Form\Product\UpdatePageUrlTForm as ProductUpdatePageUrlTForm;
use Alluco\AdminBundle\Form\Product\UpdateTForm as ProductUpdateTForm;
use Alluco\AdminBundle\Form\Product\UpdateThumbTForm as ProductUpdateThumbTForm;
use Alluco\AdminBundle\Form\Product\UpdateThumbInfoTForm as ProductUpdateThumbInfoTForm;
use Alluco\AdminBundle\Form\Product\UpdateParentTForm as ProductUpdateParentTForm;
use Alluco\AdminBundle\Form\Product\UpdateRankTForm as ProductUpdateRankTForm;
use Alluco\AdminBundle\Form\ProductTrans\UpdateNameTForm as ProductTransUpdateNameTForm;
use Alluco\AdminBundle\Form\ProductTrans\UpdateTForm as ProductTransUpdateTForm;
use Alluco\AdminBundle\Form\ProductTrans\UpdateThumbInfoTForm as ProductTransUpdateThumbInfoTForm;
use Alluco\AdminBundle\Form\Productpic\NewTForm as ProductpicNewTForm;
use Alluco\AdminBundle\Form\Productdoc\NewTForm as ProductdocNewTForm;
use Sasedev\Commons\SharedBundle\Controller\BaseController;
use Alluco\DataBundle\Entity\Productpic;
use Alluco\DataBundle\Entity\Productdoc;
use Alluco\DataBundle\Entity\ProductTrans;
use Alluco\DataBundle\Entity\ProductpicTrans;
use Alluco\DataBundle\Entity\ProductdocTrans;

/**
 * @author sasedev <sasedev.bifidis@gmail.com>
 *
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
        $products = $em->getRepository('AllucoDataBundle:Product')->getAll();
        $this->gvars['products'] = $products;

        $this->gvars['smenu_active'] = 'list';
        $this->gvars['pagetitle'] = $this->translate('Pagetitle.product.list');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.product.list.txt');
        return $this->renderResponse('AllucoAdminBundle:Product:list.html.twig', $this->gvars);
    }

    public function addGetAction()
    {
        $product = new Product();
        $productNewForm = $this->createForm(new ProductNewTForm(), $product);
        $this->gvars['product'] = $product;
        $this->gvars['ProductNewForm'] = $productNewForm->createView();

        $this->gvars['pagetitle'] = $this->translate('Pagetitle.product.add');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.product.add.txt');
        $this->gvars['smenu_active'] = 'add';

        return $this->renderResponse('AllucoAdminBundle:Product:add.html.twig', $this->gvars);
    }

    public function addPostAction()
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            return $this->redirect($this->generateUrl('_admin_product_addGet'));
        }

        $product = new Product();
        $productNewForm = $this->createForm(new ProductNewTForm(), $product);

        $request = $this->getRequest();
        $reqData = $request->request->all();

        if (isset($reqData['ProductNewForm'])) {
            $productNewForm->handleRequest($request);
            if ($productNewForm->isValid()) {
                $em = $this->getEntityManager();


                $productUrl = $productNewForm['thumb']->getData();

                if (null != $productUrl) {

                    $productDir = $this->getParameter('kernel.root_dir').'/../web/res/prods';

                    $fileName = sha1(uniqid(mt_rand(), true)).'.'.strtolower($productUrl->getClientOriginalExtension());
                    $productUrl->move($productDir, $fileName);

                    $product->setThumb($fileName);
                }

                $em->persist($product);
                $em->flush();

                $langs = $em->getRepository('AllucoDataBundle:Lang')->getAll();
                foreach ($langs as $lang) {
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
                    try {
                        $em->persist($productTrans);
                        $em->flush();
                    } catch (\Exception $e) {
                        // ne rien faire
                    }
                }
                $this->flashMsgSession(
                    'success',
                    $this->translate('Product.add.success', array('%product%' => $product->getName()))
                );

                return $this->redirect(
                    $this->generateUrl('_admin_product_editGet', array('id' => $product->getId()))
                );
            } else {
                $this->flashMsgSession(
                    'error',
                    $this->translate('Product.add.failure', array('%product%' => $productNewForm['name']->getData()))
                );
            }
        }
        $this->gvars['product'] = $product;
        $this->gvars['ProductNewForm'] = $productNewForm->createView();

        $this->gvars['pagetitle'] = $this->translate('Pagetitle.product.add');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.product.add.txt');
        $this->gvars['smenu_active'] = 'add';

        return $this->renderResponse('AllucoAdminBundle:Product:add.html.twig', $this->gvars);
    }

    public function deleteAction($id)
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_admin_product_list');
        }
        $em = $this->getEntityManager();
        try {
            $product = $em->getRepository('AllucoDataBundle:Product')->find($id);

            if (null == $product) {
                $this->flashMsgSession('warning', 'Product.delete.notfound');
            } else {
                $em->remove($product);
                $em->flush();

                $this->flashMsgSession(
                    'success',
                    $this->translate('Product.delete.success', array('%product%' => $product->getName()))
                );
            }
        } catch (\Exception $e) {
            $logger = $this->getLogger();
            $logger->addCritical($e->getLine().' '.$e->getMessage().' '.$e->getTraceAsString());

            $this->flashMsgSession('error', $this->translate('Product.delete.failure'));
        }

        return $this->redirect($urlFrom);

    }

    public function editGetAction($id)
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_admin_product_list');
        }

        $em = $this->getEntityManager();
        try {
            $product = $em->getRepository('AllucoDataBundle:Product')->find($id);

            if (null == $product) {
                $this->flashMsgSession('warning', 'Product.edit.notfound');
            } else {
                $productUpdateForm = $this->createForm(new ProductUpdateTForm(), $product);
                $productUpdatePageUrlForm = $this->createForm(new ProductUpdatePageUrlTForm(), $product);
                $productUpdateThumbForm = $this->createForm(new ProductUpdateThumbTForm(), $product);
                $productUpdateThumbInfoForm = $this->createForm(new ProductUpdateThumbInfoTForm(), $product);
                $productUpdateRankForm = $this->createForm(new ProductUpdateRankTForm(), $product);
                $productUpdateNameForm = $this->createForm(new ProductUpdateNameTForm(), $product);
                $productUpdateParentForm = $this->createForm(new ProductUpdateParentTForm($product->getPageUrlFull()), $product);


                $productpic = new Productpic();
                $productpic->setProduct($product);
                $productpicNewForm = $this->createForm(new ProductpicNewTForm($product), $productpic);


                $productdoc = new Productdoc();
                $productdoc->setProduct($product);
                $productdocNewForm = $this->createForm(new ProductdocNewTForm($product), $productdoc);

                $langs = $em->getRepository('AllucoDataBundle:Lang')->getAll();
                $this->gvars['langs'] = $langs;

                foreach ($langs as $lang) {
                    $productTrans = $em->getRepository('AllucoDataBundle:ProductTrans')->findOneBy(array('lang' => $lang, 'product' => $product));
                    if (null == $productTrans) {
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
                        try {
                            $em->persist($productTrans);
                            $em->flush();
                        } catch (\Exception $e) {
                            // ne rien faire
                        }
                    }
                }

                $em->refresh($product);


                foreach ($product->getI18ns() as $productTrans) {
                    $productTransUpdateNameForm = $this->createForm(new ProductTransUpdateNameTForm($productTrans->getLang()->getLocale()), $productTrans);
                    $productTransUpdateForm = $this->createForm(new ProductTransUpdateTForm($productTrans->getLang()->getLocale()), $productTrans);
                    $productTransUpdateThumbInfoForm = $this->createForm(new ProductTransUpdateThumbInfoTForm($productTrans->getLang()->getLocale()), $productTrans);

                    $this->gvars['ProductTransUpdateNameForm'][$productTrans->getLang()->getLocale()] = $productTransUpdateNameForm->createView();
                    $this->gvars['ProductTransUpdateForm'][$productTrans->getLang()->getLocale()] = $productTransUpdateForm->createView();
                    $this->gvars['ProductTransUpdateThumbInfoForm'][$productTrans->getLang()->getLocale()] = $productTransUpdateThumbInfoForm->createView();
                }

                /*

                $langs = $em->getRepository('AllucoDataBundle:Lang')->getAll();

                //$product = $em->getRepository('AllucoDataBundle:Product')->find($id);



                //
                //*/

                $this->gvars['product'] = $product;
                $this->gvars['ProductUpdateForm'] = $productUpdateForm->createView();
                $this->gvars['ProductUpdatePageUrlForm'] = $productUpdatePageUrlForm->createView();
                $this->gvars['ProductUpdateThumbForm'] = $productUpdateThumbForm->createView();
                $this->gvars['ProductUpdateThumbInfoForm'] = $productUpdateThumbInfoForm->createView();
                $this->gvars['ProductUpdateRankForm'] = $productUpdateRankForm->createView();
                $this->gvars['ProductUpdateNameForm'] = $productUpdateNameForm->createView();
                $this->gvars['ProductpicNewForm'] = $productpicNewForm->createView();
                $this->gvars['ProductdocNewForm'] = $productdocNewForm->createView();
                $this->gvars['ProductUpdateParentForm'] = $productUpdateParentForm->createView();

                $this->gvars['tabActive'] = $this->getSession()->get('tabActive', 1);
                $this->getSession()->remove('tabActive');

                $this->gvars['pagetitle'] = $this->translate('Pagetitle.product.edit', array('%product%' => $product->getName()));
                $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.product.edit.txt', array('%product%' => $product->getName()));

                return $this->renderResponse('AllucoAdminBundle:Product:edit.html.twig', $this->gvars);
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
            return $this->redirect($this->generateUrl('_admin_product_list'));
        }

        $em = $this->getEntityManager();
        try {
            $product = $em->getRepository('AllucoDataBundle:Product')->find($id);

            if (null == $product) {
                $this->flashMsgSession('warning', 'Product.edit.notfound');
            } else {
                $productUpdateForm = $this->createForm(new ProductUpdateTForm(), $product);
                $productUpdatePageUrlForm = $this->createForm(new ProductUpdatePageUrlTForm(), $product);
                $productUpdateThumbForm = $this->createForm(new ProductUpdateThumbTForm(), $product);
                $productUpdateThumbInfoForm = $this->createForm(new ProductUpdateThumbInfoTForm(), $product);
                $productUpdateRankForm = $this->createForm(new ProductUpdateRankTForm(), $product);
                $productUpdateNameForm = $this->createForm(new ProductUpdateNameTForm(), $product);
                $productUpdateParentForm = $this->createForm(new ProductUpdateParentTForm($product->getPageUrlFull()), $product);


                $productpic = new Productpic();
                $productpic->setProduct($product);
                $productpicNewForm = $this->createForm(new ProductpicNewTForm($product), $productpic);


                $productdoc = new Productdoc();
                $productdoc->setProduct($product);
                $productdocNewForm = $this->createForm(new ProductdocNewTForm($product), $productdoc);

                $langs = $em->getRepository('AllucoDataBundle:Lang')->getAll();
                $this->gvars['langs'] = $langs;

                foreach ($langs as $lang) {
                    $productTrans = $em->getRepository('AllucoDataBundle:ProductTrans')->findOneBy(array('lang' => $lang, 'product' => $product));
                    if (null == $productTrans) {
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
                        try {
                            $em->persist($productTrans);
                            $em->flush();
                        } catch (\Exception $e) {
                            // ne rien faire
                        }
                    }
                }

                $em->refresh($product);


                $this->gvars['tabActive'] = $this->getSession()->get('tabActive', 2);
                $this->getSession()->remove('tabActive');

                $request = $this->getRequest();
                $reqData = $request->request->all();

                if (isset($reqData['ProductUpdateNameForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $productUpdateNameForm->handleRequest($request);
                    if ($productUpdateNameForm->isValid()) {
                        $em->persist($product);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('Product.edit.success', array('%product%' => $product->getName()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($product);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('Product.edit.failure', array('%product%' => $product->getName()))
                        );
                    }
                } elseif (isset($reqData['ProductUpdatePageUrlForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $productUpdatePageUrlForm->handleRequest($request);
                    if ($productUpdatePageUrlForm->isValid()) {
                        $slug = $this->get('cocur_slugify')->slugify($productUpdatePageUrlForm['pageUrl']->getData(), '_');
                        $foundSlug = false;

                        do {
                            $productTest = $em->getRepository('AllucoDataBundle:Product')->findOneBy(array('pageUrl' => $slug));
                            if (null != $productTest && $productTest->getId() != $product->getId()) {
                                $foundSlug = true;
                                $slug = $slug.'_1';
                            } else {
                                $foundSlug = false;
                            }
                        } while ($foundSlug == true);

                        $product->setPageUrl($slug);

                        $em->persist($product);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('Product.edit.success', array('%product%' => $product->getName()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($product);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('Product.edit.failure', array('%product%' => $product->getName()))
                        );
                    }
                } elseif (isset($reqData['ProductUpdateForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $productUpdateForm->handleRequest($request);
                    if ($productUpdateForm->isValid()) {
                        $em->persist($product);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('Product.edit.success', array('%product%' => $product->getName()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($product);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('Product.edit.failure', array('%product%' => $product->getName()))
                        );
                    }
                } elseif (isset($reqData['ProductUpdateThumbForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $productUpdateThumbForm->handleRequest($request);
                    if ($productUpdateThumbForm->isValid()) {
                        $productUrl = $productUpdateThumbForm['thumb']->getData();

                        $productDir = $this->getParameter('kernel.root_dir').'/../web/res/prods';

                        $fileName = sha1(uniqid(mt_rand(), true)).'.'.strtolower($productUrl->getClientOriginalExtension());
                        $productUrl->move($productDir, $fileName);

                        $product->setThumb($fileName);
                        $em->persist($product);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('Product.edit.success', array('%product%' => $product->getName()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($product);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('Product.edit.failure', array('%product%' => $product->getName()))
                        );
                    }
                } elseif (isset($reqData['ProductUpdateThumbInfoForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $productUpdateThumbInfoForm->handleRequest($request);
                    if ($productUpdateThumbInfoForm->isValid()) {
                        $em->persist($product);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('Product.edit.success', array('%product%' => $product->getName()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($product);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('Product.edit.failure', array('%product%' => $product->getName()))
                        );
                    }
                } elseif (isset($reqData['ProductUpdateRankForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $productUpdateRankForm->handleRequest($request);
                    if ($productUpdateRankForm->isValid()) {
                        $em->persist($product);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('Product.edit.success', array('%product%' => $product->getName()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($product);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('Product.edit.failure', array('%product%' => $product->getName()))
                        );
                    }
                } elseif (isset($reqData['ProductpicNewForm'])) {
                    $this->gvars['tabActive'] = 3;
                    $this->getSession()->set('tabActive', 3);
                    $productpicNewForm->handleRequest($request);
                    if ($productpicNewForm->isValid()) {
                        $productpicUrl = $productpicNewForm['filename']->getData();

                        $productpicDir = $this->getParameter('kernel.root_dir').'/../web/res/pics';

                        $fileName = sha1(uniqid(mt_rand(), true)).'.'.strtolower($productpicUrl->getClientOriginalExtension());
                        $productpicUrl->move($productpicDir, $fileName);

                        $productpic->setFilename($fileName);
                        $em->persist($productpic);
                        $em->flush();

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

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($product);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('Product.edit.failure', array('%product%' => $product->getName()))
                        );
                    }
                } elseif (isset($reqData['ProductdocNewForm'])) {
                    $this->gvars['tabActive'] = 4;
                    $this->getSession()->set('tabActive', 4);
                    $productdocNewForm->handleRequest($request);
                    if ($productdocNewForm->isValid()) {
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

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($product);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('Product.edit.failure', array('%product%' => $product->getName()))
                        );
                    }
                } elseif (isset($reqData['ProductUpdateParentForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $productUpdateParentForm->handleRequest($request);
                    if ($productUpdateParentForm->isValid()) {
                        $em->persist($product);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('Product.edit.success', array('%product%' => $product->getName()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($product);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('Product.edit.failure', array('%product%' => $product->getName()))
                        );
                    }
                } //*/

                foreach ($product->getI18ns() as $productTrans) {
                    $em->refresh($productTrans);
                    $productTransUpdateNameForm = $this->createForm(new ProductTransUpdateNameTForm($productTrans->getLang()->getLocale()), $productTrans);
                    $productTransUpdateForm = $this->createForm(new ProductTransUpdateTForm($productTrans->getLang()->getLocale()), $productTrans);
                    $productTransUpdateThumbInfoForm = $this->createForm(new ProductTransUpdateThumbInfoTForm($productTrans->getLang()->getLocale()), $productTrans);

                    if (isset($reqData['ProductTransUpdateForm_'.$productTrans->getLang()->getLocale()])) {
                        $this->gvars['tabActive'] = $productTrans->getLang()->getLocale();
                        $this->getSession()->set('tabActive', $productTrans->getLang()->getLocale());
                        $productTransUpdateForm->handleRequest($request);
                        if ($productTransUpdateForm->isValid()) {
                            $em->persist($productTrans);
                            $em->flush();
                            $this->flashMsgSession(
                                'success',
                                $this->translate('ProductTrans.edit.success', array('%product%' => $product->getName()))
                            );

                            return $this->redirect($urlFrom);
                        } else {
                            $em->refresh($product);

                            $this->flashMsgSession(
                                'error',
                                $this->translate('ProductTrans.edit.failure', array('%product%' => $product->getName()))
                            );
                        }
                    } elseif (isset($reqData['ProductTransUpdateThumbInfoForm_'.$productTrans->getLang()->getLocale()])) {
                        $this->gvars['tabActive'] = $productTrans->getLang()->getLocale();
                        $this->getSession()->set('tabActive', $productTrans->getLang()->getLocale());
                        $productTransUpdateThumbInfoForm->handleRequest($request);
                        if ($productTransUpdateThumbInfoForm->isValid()) {
                            $em->persist($productTrans);
                            $em->flush();
                            $this->flashMsgSession(
                                'success',
                                $this->translate('ProductTrans.edit.success', array('%product%' => $product->getName()))
                            );

                            return $this->redirect($urlFrom);
                        } else {
                            $em->refresh($product);

                            $this->flashMsgSession(
                                'error',
                                $this->translate('ProductTrans.edit.failure', array('%product%' => $product->getName()))
                            );
                        }
                    } elseif (isset($reqData['ProductTransUpdateNameForm_'.$productTrans->getLang()->getLocale()])) {
                        $this->gvars['tabActive'] = $productTrans->getLang()->getLocale();
                        $this->getSession()->set('tabActive', $productTrans->getLang()->getLocale());
                        $productTransUpdateNameForm->handleRequest($request);
                        if ($productTransUpdateNameForm->isValid()) {
                            $em->persist($productTrans);
                            $em->flush();
                            $this->flashMsgSession(
                                'success',
                                $this->translate('ProductTrans.edit.success', array('%product%' => $product->getName()))
                            );

                            return $this->redirect($urlFrom);
                        } else {
                            $em->refresh($product);

                            $this->flashMsgSession(
                                'error',
                                $this->translate('ProductTrans.edit.failure', array('%product%' => $product->getName()))
                            );
                        }
                    }

                    $this->gvars['ProductTransUpdateNameForm'][$productTrans->getLang()->getLocale()] = $productTransUpdateNameForm->createView();
                    $this->gvars['ProductTransUpdateForm'][$productTrans->getLang()->getLocale()] = $productTransUpdateForm->createView();
                    $this->gvars['ProductTransUpdateThumbInfoForm'][$productTrans->getLang()->getLocale()] = $productTransUpdateThumbInfoForm->createView();
                }

                $this->gvars['product'] = $product;

                $this->gvars['ProductUpdateForm'] = $productUpdateForm->createView();
                $this->gvars['ProductUpdatePageUrlForm'] = $productUpdatePageUrlForm->createView();
                $this->gvars['ProductUpdateThumbForm'] = $productUpdateThumbForm->createView();
                $this->gvars['ProductUpdateThumbInfoForm'] = $productUpdateThumbInfoForm->createView();
                $this->gvars['ProductUpdateRankForm'] = $productUpdateRankForm->createView();
                $this->gvars['ProductUpdateNameForm'] = $productUpdateNameForm->createView();
                $this->gvars['ProductpicNewForm'] = $productpicNewForm->createView();
                $this->gvars['ProductdocNewForm'] = $productdocNewForm->createView();
                $this->gvars['ProductUpdateParentForm'] = $productUpdateParentForm->createView();

                $this->gvars['pagetitle'] = $this->translate('Pagetitle.product.edit', array('%product%' => $product->getName()));
                $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.product.edit.txt', array('%product%' => $product->getName()));

                return $this->renderResponse('AllucoAdminBundle:Product:edit.html.twig', $this->gvars);
            }
        } catch (\Exception $e) {
            $logger = $this->getLogger();
            $logger->addCritical($e->getLine().' '.$e->getMessage().' '.$e->getTraceAsString());
        }

        return $this->redirect($urlFrom);

    }
}
