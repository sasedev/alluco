<?php

namespace Alluco\AdminBundle\Controller;

use Alluco\DataBundle\Entity\ConstantFloat;
use Alluco\AdminBundle\Form\ConstantFloat\NewTForm as ConstantFloatNewTForm;
use Alluco\AdminBundle\Form\ConstantFloat\UpdateDescriptionTForm as ConstantFloatUpdateDescriptionTForm;
use Alluco\AdminBundle\Form\ConstantFloat\UpdateValueTForm as ConstantFloatUpdateValueTForm;
use Sasedev\Commons\SharedBundle\Controller\BaseController;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class ConstantFloatController extends BaseController
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

        $this->gvars['menu_active'] = 'constantFloat';

    }

    public function listAction()
    {
        $em = $this->getEntityManager();
        $constantFloats = $em->getRepository('AllucoDataBundle:ConstantFloat')->getAll();
        $this->gvars['constantFloats'] = $constantFloats;

        $this->gvars['smenu_active'] = 'list';
        $this->gvars['pagetitle'] = $this->translate('Pagetitle.constantFloat.list');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.constantFloat.list.txt');
        return $this->renderResponse('AllucoAdminBundle:ConstantFloat:list.html.twig', $this->gvars);
    }

    public function addGetAction()
    {
        $constantFloat = new ConstantFloat();
        $constantFloatNewForm = $this->createForm(new ConstantFloatNewTForm(), $constantFloat);
        $this->gvars['constantFloat'] = $constantFloat;
        $this->gvars['ConstantFloatNewForm'] = $constantFloatNewForm->createView();

        $this->gvars['pagetitle'] = $this->translate('Pagetitle.constantFloat.add');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.constantFloat.add.txt');
        $this->gvars['smenu_active'] = 'add';

        return $this->renderResponse('AllucoAdminBundle:ConstantFloat:add.html.twig', $this->gvars);
    }

    public function addPostAction()
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            return $this->redirect($this->generateUrl('_admin_constantFloat_addGet'));
        }

        $constantFloat = new ConstantFloat();
        $constantFloatNewForm = $this->createForm(new ConstantFloatNewTForm(), $constantFloat);

        $request = $this->getRequest();
        $reqData = $request->request->all();

        if (isset($reqData['ConstantFloatNewForm'])) {
            $constantFloatNewForm->handleRequest($request);
            if ($constantFloatNewForm->isValid()) {
                $em = $this->getEntityManager();
                $em->persist($constantFloat);
                $em->flush();
                $this->flashMsgSession(
                    'success',
                    $this->translate('ConstantFloat.add.success', array('%constantFloat%' => $constantFloat->getName()))
                );

                return $this->redirect(
                    $this->generateUrl('_admin_constantFloat_editGet', array('uid' => $constantFloat->getId()))
                );
            } else {
                $this->flashMsgSession(
                    'error',
                    $this->translate('ConstantFloat.add.failure', array('%constantFloat%' => $constantFloatNewForm['name']->getData()))
                );
            }
        }
        $this->gvars['constantFloat'] = $constantFloat;
        $this->gvars['ConstantFloatNewForm'] = $constantFloatNewForm->createView();

        $this->gvars['pagetitle'] = $this->translate('Pagetitle.constantFloat.add');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.constantFloat.add.txt');
        $this->gvars['smenu_active'] = 'add';

        return $this->renderResponse('AllucoAdminBundle:ConstantFloat:add.html.twig', $this->gvars);
    }

    public function deleteAction($uid)
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_admin_constantFloat_list');
        }
        $em = $this->getEntityManager();
        try {
            $constantFloat = $em->getRepository('AllucoDataBundle:ConstantFloat')->find($uid);

            if (null == $constantFloat) {
                $this->flashMsgSession('warning', 'ConstantFloat.delete.notfound');
            } else {
                $em->remove($constantFloat);
                $em->flush();

                $this->flashMsgSession(
                    'success',
                    $this->translate('ConstantFloat.delete.success', array('%constantFloat%' => $constantFloat->getName()))
                );
            }
        } catch (\Exception $e) {
            $logger = $this->getLogger();
            $logger->addCritical($e->getLine().' '.$e->getMessage().' '.$e->getTraceAsString());

            $this->flashMsgSession('error', $this->translate('ConstantFloat.delete.failure'));
        }

        return $this->redirect($urlFrom);

    }

    public function editGetAction($uid)
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_admin_constantFloat_list');
        }

        $em = $this->getEntityManager();
        try {
            $constantFloat = $em->getRepository('AllucoDataBundle:ConstantFloat')->find($uid);

            if (null == $constantFloat) {
                $this->flashMsgSession('warning', 'ConstantFloat.edit.notfound');
            } else {
                $constantFloatUpdateDescriptionForm = $this->createForm(new ConstantFloatUpdateDescriptionTForm(), $constantFloat);
                $constantFloatUpdateValueForm = $this->createForm(new ConstantFloatUpdateValueTForm(), $constantFloat);

                $this->gvars['constantFloat'] = $constantFloat;
                $this->gvars['ConstantFloatUpdateDescriptionForm'] = $constantFloatUpdateDescriptionForm->createView();
                $this->gvars['ConstantFloatUpdateValueForm'] = $constantFloatUpdateValueForm->createView();

                $this->gvars['tabActive'] = $this->getSession()->get('tabActive', 1);
                $this->getSession()->remove('tabActive');



                $this->gvars['pagetitle'] = $this->translate('Pagetitle.constantFloat.edit', array('%constantFloat%' => $constantFloat->getName()));
                $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.constantFloat.edit.txt', array('%constantFloat%' => $constantFloat->getName()));

                return $this->renderResponse('AllucoAdminBundle:ConstantFloat:edit.html.twig', $this->gvars);
            }
        } catch (\Exception $e) {
            $logger = $this->getLogger();
            $logger->addCritical($e->getLine().' '.$e->getMessage().' '.$e->getTraceAsString());
        }

        return $this->redirect($urlFrom);
    }


    public function editPostAction($uid)
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            return $this->redirect($this->generateUrl('_admin_constantFloat_list'));
        }

        $em = $this->getEntityManager();
        try {
            $constantFloat = $em->getRepository('AllucoDataBundle:ConstantFloat')->find($uid);

            if (null == $constantFloat) {
                $this->flashMsgSession('warning', 'ConstantFloat.edit.notfound');
            } else {
                $constantFloatUpdateDescriptionForm = $this->createForm(new ConstantFloatUpdateDescriptionTForm(), $constantFloat);
                $constantFloatUpdateValueForm = $this->createForm(new ConstantFloatUpdateValueTForm(), $constantFloat);



                $this->gvars['tabActive'] = $this->getSession()->get('tabActive', 2);
                $this->getSession()->remove('tabActive');

                $request = $this->getRequest();
                $reqData = $request->request->all();

                if (isset($reqData['ConstantFloatUpdateDescriptionForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $constantFloatUpdateDescriptionForm->handleRequest($request);
                    if ($constantFloatUpdateDescriptionForm->isValid()) {
                        $em->persist($constantFloat);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('ConstantFloat.edit.success', array('%constantFloat%' => $constantFloat->getName()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($constantFloat);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('ConstantFloat.edit.failure', array('%constantFloat%' => $constantFloat->getName()))
                        );
                    }
                } elseif (isset($reqData['ConstantFloatUpdateValueForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $constantFloatUpdateValueForm->handleRequest($request);
                    if ($constantFloatUpdateValueForm->isValid()) {
                        $em->persist($constantFloat);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('ConstantFloat.edit.success', array('%constantFloat%' => $constantFloat->getName()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($constantFloat);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('ConstantFloat.edit.failure', array('%constantFloat%' => $constantFloat->getName()))
                        );
                    }
                }

                $this->gvars['constantFloat'] = $constantFloat;
                $this->gvars['ConstantFloatUpdateDescriptionForm'] = $constantFloatUpdateDescriptionForm->createView();
                $this->gvars['ConstantFloatUpdateValueForm'] = $constantFloatUpdateValueForm->createView();

                $this->gvars['pagetitle'] = $this->translate('Pagetitle.constantFloat.edit', array('%constantFloat%' => $constantFloat->getName()));
                $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.constantFloat.edit.txt', array('%constantFloat%' => $constantFloat->getName()));

                return $this->renderResponse('AllucoAdminBundle:ConstantFloat:edit.html.twig', $this->gvars);
            }
        } catch (\Exception $e) {
            $logger = $this->getLogger();
            $logger->addCritical($e->getLine().' '.$e->getMessage().' '.$e->getTraceAsString());
        }

        return $this->redirect($urlFrom);

    }
}
