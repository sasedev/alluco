<?php

namespace Alluco\AdminBundle\Controller;

use Alluco\DataBundle\Entity\ConstantInt;
use Alluco\AdminBundle\Form\ConstantInt\NewTForm as ConstantIntNewTForm;
use Alluco\AdminBundle\Form\ConstantInt\UpdateDescriptionTForm as ConstantIntUpdateDescriptionTForm;
use Alluco\AdminBundle\Form\ConstantInt\UpdateValueTForm as ConstantIntUpdateValueTForm;
use Sasedev\Commons\SharedBundle\Controller\BaseController;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class ConstantIntController extends BaseController
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

        $this->gvars['menu_active'] = 'constantInt';

    }

    public function listAction()
    {
        $em = $this->getEntityManager();
        $constantInts = $em->getRepository('AllucoDataBundle:ConstantInt')->getAll();
        $this->gvars['constantInts'] = $constantInts;

        $this->gvars['smenu_active'] = 'list';
        $this->gvars['pagetitle'] = $this->translate('Pagetitle.constantInt.list');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.constantInt.list.txt');
        return $this->renderResponse('AllucoAdminBundle:ConstantInt:list.html.twig', $this->gvars);
    }

    public function addGetAction()
    {
        $constantInt = new ConstantInt();
        $constantIntNewForm = $this->createForm(new ConstantIntNewTForm(), $constantInt);
        $this->gvars['constantInt'] = $constantInt;
        $this->gvars['ConstantIntNewForm'] = $constantIntNewForm->createView();

        $this->gvars['pagetitle'] = $this->translate('Pagetitle.constantInt.add');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.constantInt.add.txt');
        $this->gvars['smenu_active'] = 'add';

        return $this->renderResponse('AllucoAdminBundle:ConstantInt:add.html.twig', $this->gvars);
    }

    public function addPostAction()
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            return $this->redirect($this->generateUrl('_admin_constantInt_addGet'));
        }

        $constantInt = new ConstantInt();
        $constantIntNewForm = $this->createForm(new ConstantIntNewTForm(), $constantInt);

        $request = $this->getRequest();
        $reqData = $request->request->all();

        if (isset($reqData['ConstantIntNewForm'])) {
            $constantIntNewForm->handleRequest($request);
            if ($constantIntNewForm->isValid()) {
                $em = $this->getEntityManager();
                $em->persist($constantInt);
                $em->flush();
                $this->flashMsgSession(
                    'success',
                    $this->translate('ConstantInt.add.success', array('%constantInt%' => $constantInt->getName()))
                );

                return $this->redirect(
                    $this->generateUrl('_admin_constantInt_editGet', array('uid' => $constantInt->getId()))
                );
            } else {
                $this->flashMsgSession(
                    'error',
                    $this->translate('ConstantInt.add.failure', array('%constantInt%' => $constantIntNewForm['name']->getData()))
                );
            }
        }
        $this->gvars['constantInt'] = $constantInt;
        $this->gvars['ConstantIntNewForm'] = $constantIntNewForm->createView();

        $this->gvars['pagetitle'] = $this->translate('Pagetitle.constantInt.add');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.constantInt.add.txt');
        $this->gvars['smenu_active'] = 'add';

        return $this->renderResponse('AllucoAdminBundle:ConstantInt:add.html.twig', $this->gvars);
    }

    public function deleteAction($uid)
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_admin_constantInt_list');
        }
        $em = $this->getEntityManager();
        try {
            $constantInt = $em->getRepository('AllucoDataBundle:ConstantInt')->find($uid);

            if (null == $constantInt) {
                $this->flashMsgSession('warning', 'ConstantInt.delete.notfound');
            } else {
                $em->remove($constantInt);
                $em->flush();

                $this->flashMsgSession(
                    'success',
                    $this->translate('ConstantInt.delete.success', array('%constantInt%' => $constantInt->getName()))
                );
            }
        } catch (\Exception $e) {
            $logger = $this->getLogger();
            $logger->addCritical($e->getLine().' '.$e->getMessage().' '.$e->getTraceAsString());

            $this->flashMsgSession('error', $this->translate('ConstantInt.delete.failure'));
        }

        return $this->redirect($urlFrom);

    }

    public function editGetAction($uid)
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_admin_constantInt_list');
        }

        $em = $this->getEntityManager();
        try {
            $constantInt = $em->getRepository('AllucoDataBundle:ConstantInt')->find($uid);

            if (null == $constantInt) {
                $this->flashMsgSession('warning', 'ConstantInt.edit.notfound');
            } else {
                $constantIntUpdateDescriptionForm = $this->createForm(new ConstantIntUpdateDescriptionTForm(), $constantInt);
                $constantIntUpdateValueForm = $this->createForm(new ConstantIntUpdateValueTForm(), $constantInt);

                $this->gvars['constantInt'] = $constantInt;
                $this->gvars['ConstantIntUpdateDescriptionForm'] = $constantIntUpdateDescriptionForm->createView();
                $this->gvars['ConstantIntUpdateValueForm'] = $constantIntUpdateValueForm->createView();

                $this->gvars['tabActive'] = $this->getSession()->get('tabActive', 1);
                $this->getSession()->remove('tabActive');



                $this->gvars['pagetitle'] = $this->translate('Pagetitle.constantInt.edit', array('%constantInt%' => $constantInt->getName()));
                $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.constantInt.edit.txt', array('%constantInt%' => $constantInt->getName()));

                return $this->renderResponse('AllucoAdminBundle:ConstantInt:edit.html.twig', $this->gvars);
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
            return $this->redirect($this->generateUrl('_admin_constantInt_list'));
        }

        $em = $this->getEntityManager();
        try {
            $constantInt = $em->getRepository('AllucoDataBundle:ConstantInt')->find($uid);

            if (null == $constantInt) {
                $this->flashMsgSession('warning', 'ConstantInt.edit.notfound');
            } else {
                $constantIntUpdateDescriptionForm = $this->createForm(new ConstantIntUpdateDescriptionTForm(), $constantInt);
                $constantIntUpdateValueForm = $this->createForm(new ConstantIntUpdateValueTForm(), $constantInt);



                $this->gvars['tabActive'] = $this->getSession()->get('tabActive', 2);
                $this->getSession()->remove('tabActive');

                $request = $this->getRequest();
                $reqData = $request->request->all();

                if (isset($reqData['ConstantIntUpdateDescriptionForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $constantIntUpdateDescriptionForm->handleRequest($request);
                    if ($constantIntUpdateDescriptionForm->isValid()) {
                        $em->persist($constantInt);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('ConstantInt.edit.success', array('%constantInt%' => $constantInt->getName()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($constantInt);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('ConstantInt.edit.failure', array('%constantInt%' => $constantInt->getName()))
                        );
                    }
                } elseif (isset($reqData['ConstantIntUpdateValueForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $constantIntUpdateValueForm->handleRequest($request);
                    if ($constantIntUpdateValueForm->isValid()) {
                        $em->persist($constantInt);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('ConstantInt.edit.success', array('%constantInt%' => $constantInt->getName()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($constantInt);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('ConstantInt.edit.failure', array('%constantInt%' => $constantInt->getName()))
                        );
                    }
                }

                $this->gvars['constantInt'] = $constantInt;
                $this->gvars['ConstantIntUpdateDescriptionForm'] = $constantIntUpdateDescriptionForm->createView();
                $this->gvars['ConstantIntUpdateValueForm'] = $constantIntUpdateValueForm->createView();

                $this->gvars['pagetitle'] = $this->translate('Pagetitle.constantInt.edit', array('%constantInt%' => $constantInt->getName()));
                $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.constantInt.edit.txt', array('%constantInt%' => $constantInt->getName()));

                return $this->renderResponse('AllucoAdminBundle:ConstantInt:edit.html.twig', $this->gvars);
            }
        } catch (\Exception $e) {
            $logger = $this->getLogger();
            $logger->addCritical($e->getLine().' '.$e->getMessage().' '.$e->getTraceAsString());
        }

        return $this->redirect($urlFrom);

    }
}
