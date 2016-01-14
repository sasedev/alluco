<?php

namespace Alluco\AdminBundle\Controller;

use Alluco\DataBundle\Entity\Role;
use Alluco\AdminBundle\Form\Role\NewTForm as RoleNewTForm;
use Alluco\AdminBundle\Form\Role\UpdateDescriptionTForm as RoleUpdateDescriptionTForm;
use Alluco\AdminBundle\Form\Role\UpdateParentsTForm as RoleUpdateParentsTForm;
use Sasedev\Commons\SharedBundle\Controller\BaseController;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class RoleController extends BaseController
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

        $this->gvars['menu_active'] = 'role';

    }

    public function listAction()
    {
        $em = $this->getEntityManager();
        $roles = $em->getRepository('AllucoDataBundle:Role')->getAll();
        $this->gvars['roles'] = $roles;

        $this->gvars['smenu_active'] = 'list';
        $this->gvars['pagetitle'] = $this->translate('Pagetitle.role.list');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.role.list.txt');
        return $this->renderResponse('AllucoAdminBundle:Role:list.html.twig', $this->gvars);
    }

    public function addGetAction()
    {
        $role = new Role();
        $roleNewForm = $this->createForm(new RoleNewTForm(), $role);
        $this->gvars['role'] = $role;
        $this->gvars['RoleNewForm'] = $roleNewForm->createView();

        $this->gvars['pagetitle'] = $this->translate('Pagetitle.role.add');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.role.add.txt');
        $this->gvars['smenu_active'] = 'add';

        return $this->renderResponse('AllucoAdminBundle:Role:add.html.twig', $this->gvars);
    }

    public function addPostAction()
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            return $this->redirect($this->generateUrl('_admin_role_addGet'));
        }

        $role = new Role();
        $roleNewForm = $this->createForm(new RoleNewTForm(), $role);

        $request = $this->getRequest();
        $reqData = $request->request->all();

        if (isset($reqData['RoleNewForm'])) {
            $roleNewForm->handleRequest($request);
            if ($roleNewForm->isValid()) {
                $em = $this->getEntityManager();
                $em->persist($role);
                $em->flush();
                $this->flashMsgSession(
                    'success',
                    $this->translate('Role.add.success', array('%role%' => $role->getName()))
                );

                return $this->redirect(
                    $this->generateUrl('_admin_role_editGet', array('id' => $role->getId()))
                );
            } else {
                $this->flashMsgSession(
                    'error',
                    $this->translate('Role.add.failure', array('%role%' => $roleNewForm['name']->getData()))
                );
            }
        }
        $this->gvars['role'] = $role;
        $this->gvars['RoleNewForm'] = $roleNewForm->createView();

        $this->gvars['pagetitle'] = $this->translate('Pagetitle.role.add');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.role.add.txt');
        $this->gvars['smenu_active'] = 'add';

        return $this->renderResponse('AllucoAdminBundle:Role:add.html.twig', $this->gvars);
    }

    public function deleteAction($id)
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_admin_role_list');
        }
        $em = $this->getEntityManager();
        try {
            $role = $em->getRepository('AllucoDataBundle:Role')->find($id);

            if (null == $role) {
                $this->flashMsgSession('warning', 'Role.delete.notfound');
            } else {
                $em->remove($role);
                $em->flush();

                $this->flashMsgSession(
                    'success',
                    $this->translate('Role.delete.success', array('%role%' => $role->getName()))
                );
            }
        } catch (\Exception $e) {
            $logger = $this->getLogger();
            $logger->addCritical($e->getLine().' '.$e->getMessage().' '.$e->getTraceAsString());

            $this->flashMsgSession('error', $this->translate('Role.delete.failure'));
        }

        return $this->redirect($urlFrom);

    }

    public function editGetAction($id)
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_admin_role_list');
        }

        $em = $this->getEntityManager();
        try {
            $role = $em->getRepository('AllucoDataBundle:Role')->find($id);

            if (null == $role) {
                $this->flashMsgSession('warning', 'Role.edit.notfound');
            } else {
                $roleUpdateDescriptionForm = $this->createForm(new RoleUpdateDescriptionTForm(), $role);
                $roleUpdateParentsForm = $this->createForm(new RoleUpdateParentsTForm(), $role);

                $this->gvars['role'] = $role;
                $this->gvars['RoleUpdateDescriptionForm'] = $roleUpdateDescriptionForm->createView();
                $this->gvars['RoleUpdateParentsForm'] = $roleUpdateParentsForm->createView();

                $this->gvars['tabActive'] = $this->getSession()->get('tabActive', 1);
                $this->getSession()->remove('tabActive');



                $this->gvars['pagetitle'] = $this->translate('Pagetitle.role.edit', array('%role%' => $role->getName()));
                $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.role.edit.txt', array('%role%' => $role->getName()));

                return $this->renderResponse('AllucoAdminBundle:Role:edit.html.twig', $this->gvars);
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
            return $this->redirect($this->generateUrl('_admin_role_list'));
        }

        $em = $this->getEntityManager();
        try {
            $role = $em->getRepository('AllucoDataBundle:Role')->find($id);

            if (null == $role) {
                $this->flashMsgSession('warning', 'Role.edit.notfound');
            } else {
                $roleUpdateDescriptionForm = $this->createForm(new RoleUpdateDescriptionTForm(), $role);
                $roleUpdateParentsForm = $this->createForm(new RoleUpdateParentsTForm(), $role);



                $this->gvars['tabActive'] = $this->getSession()->get('tabActive', 2);
                $this->getSession()->remove('tabActive');

                $request = $this->getRequest();
                $reqData = $request->request->all();

                if (isset($reqData['RoleUpdateDescriptionForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $roleUpdateDescriptionForm->handleRequest($request);
                    if ($roleUpdateDescriptionForm->isValid()) {
                        $em->persist($role);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('Role.edit.success', array('%role%' => $role->getName()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($role);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('Role.edit.failure', array('%role%' => $role->getName()))
                        );
                    }
                } elseif (isset($reqData['RoleUpdateParentsForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $roleUpdateParentsForm->handleRequest($request);
                    if ($roleUpdateParentsForm->isValid()) {
                        $em->persist($role);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('Role.edit.success', array('%role%' => $role->getName()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($role);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('Role.edit.failure', array('%role%' => $role->getName()))
                        );
                    }
                }

                $this->gvars['role'] = $role;
                $this->gvars['RoleUpdateDescriptionForm'] = $roleUpdateDescriptionForm->createView();
                $this->gvars['RoleUpdateParentsForm'] = $roleUpdateParentsForm->createView();

                $this->gvars['pagetitle'] = $this->translate('Pagetitle.role.edit', array('%role%' => $role->getName()));
                $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.role.edit.txt', array('%role%' => $role->getName()));

                return $this->renderResponse('AllucoAdminBundle:Role:edit.html.twig', $this->gvars);
            }
        } catch (\Exception $e) {
            $logger = $this->getLogger();
            $logger->addCritical($e->getLine().' '.$e->getMessage().' '.$e->getTraceAsString());
        }

        return $this->redirect($urlFrom);

    }
}
