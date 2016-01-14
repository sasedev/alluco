<?php
namespace Alluco\AdminBundle\Controller;

use Alluco\DataBundle\Entity\User;
use Alluco\AdminBundle\Form\User\CropAvatarTForm as UserCropAvatarTForm;
use Alluco\AdminBundle\Form\User\NewTForm as UserNewTForm;
use Alluco\AdminBundle\Form\User\UpdateEmailTForm as UserUpdateEmailTForm;
use Alluco\AdminBundle\Form\User\UpdateLockoutTForm as UserUpdateLockoutTForm;
use Alluco\AdminBundle\Form\User\UpdatePasswordTForm as UserUpdatePasswordTForm;
use Alluco\AdminBundle\Form\User\UpdatePreferedLangTForm as UserUpdatePreferedLangTForm;
use Alluco\AdminBundle\Form\User\UpdateJobTForm as UserUpdateJobTForm;
use Alluco\AdminBundle\Form\User\UpdateProfileTForm as UserUpdateProfileTForm;
use Alluco\AdminBundle\Form\User\UpdateUserRolesTForm as UserUpdateUserRolesTForm;
use Alluco\AdminBundle\Form\User\UploadAvatarTForm as UserUploadAvatarTForm;
use Imagine\Imagick\Imagine;
use Imagine\Image\Point;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Sasedev\Commons\SharedBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @author sasedev <sasedev.bifidis@gmail.com>
 *
 */
class UserController extends BaseController
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

        $this->gvars['menu_active'] = 'user';

    }

    public function listAction()
    {
        $em = $this->getEntityManager();
        $users = $em->getRepository('AllucoDataBundle:User')->getAll();
        $this->gvars['users'] = $users;

        $this->gvars['smenu_active'] = 'list';
        $this->gvars['pagetitle'] = $this->translate('Pagetitle.user.list');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.user.list.txt');
        return $this->renderResponse('AllucoAdminBundle:User:list.html.twig', $this->gvars);
    }

    public function addGetAction()
    {
        $user = new User();
        $userNewForm = $this->createForm(new UserNewTForm(), $user);
        $this->gvars['user'] = $user;
        $this->gvars['UserNewForm'] = $userNewForm->createView();

        $this->gvars['pagetitle'] = $this->translate('Pagetitle.user.add');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.user.add.txt');
        $this->gvars['smenu_active'] = 'add';

        return $this->renderResponse('AllucoAdminBundle:User:add.html.twig', $this->gvars);
    }

    public function addPostAction()
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            return $this->redirect($this->generateUrl('_admin_user_addGet'));
        }

        $user = new User();
        $userNewForm = $this->createForm(new UserNewTForm(), $user);

        $request = $this->getRequest();
        $reqData = $request->request->all();

        if (isset($reqData['UserNewForm'])) {
            $userNewForm->handleRequest($request);
            if ($userNewForm->isValid()) {
                $em = $this->getEntityManager();
                $em->persist($user);
                $em->flush();
                $this->flashMsgSession(
                    'success',
                    $this->translate('User.add.success', array('%user%' => $user->getUsername()))
                );

                return $this->redirect(
                    $this->generateUrl('_admin_user_editGet', array('id' => $user->getId()))
                );
            } else {
                $this->flashMsgSession(
                    'error',
                    $this->translate('User.add.failure', array('%user%' => $userNewForm['username']->getData()))
                );
            }
        }
        $this->gvars['user'] = $user;
        $this->gvars['UserNewForm'] = $userNewForm->createView();

        $this->gvars['pagetitle'] = $this->translate('Pagetitle.user.add');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.user.add.txt');
        $this->gvars['smenu_active'] = 'add';

        return $this->renderResponse('AllucoAdminBundle:User:add.html.twig', $this->gvars);
    }

    public function deleteAction($id)
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_admin_user_list');
        }
        $em = $this->getEntityManager();
        try {
            $user = $em->getRepository('AllucoDataBundle:User')->find($id);

            if (null == $user) {
                $this->flashMsgSession('warning', 'User.delete.notfound');
            } else {
                $em->remove($user);
                $em->flush();

                $this->flashMsgSession(
                    'success',
                    $this->translate('User.delete.success', array('%user%' => $user->getUsername()))
                );
            }
        } catch (\Exception $e) {
            $logger = $this->getLogger();
            $logger->addCritical($e->getLine().' '.$e->getMessage().' '.$e->getTraceAsString());

            $this->flashMsgSession('error', $this->translate('User.delete.failure'));
        }

        return $this->redirect($urlFrom);

    }

    public function editGetAction($id)
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_admin_user_list');
        }

        $em = $this->getEntityManager();
        try {
            $user = $em->getRepository('AllucoDataBundle:User')->find($id);

            if (null == $user) {
                $this->flashMsgSession('warning', 'User.edit.notfound');
            } else {
                $userUpdateEmailForm = $this->createForm(new UserUpdateEmailTForm(), $user);
                $userUpdateLockoutForm = $this->createForm(new UserUpdateLockoutTForm(), $user);
                $userUpdatePasswordForm = $this->createForm(new UserUpdatePasswordTForm(), $user);
                $userUpdatePreferedLangForm = $this->createForm(new UserUpdatePreferedLangTForm(), $user);
                $userUpdateJobForm = $this->createForm(new UserUpdateJobTForm(), $user);
                $userUpdateProfileForm = $this->createForm(new UserUpdateProfileTForm(), $user);
                $userUpdateUserRolesForm = $this->createForm(new UserUpdateUserRolesTForm(), $user);
                $userUploadAvatarForm = $this->createForm(new UserUploadAvatarTForm(), $user);
                $userCropAvatarForm = $this->createForm(new UserCropAvatarTForm());

                $this->gvars['user'] = $user;
                $this->gvars['UserUpdateEmailForm'] = $userUpdateEmailForm->createView();
                $this->gvars['UserUpdateLockoutForm'] = $userUpdateLockoutForm->createView();
                $this->gvars['UserUpdatePasswordForm'] = $userUpdatePasswordForm->createView();
                $this->gvars['UserUpdatePreferedLangForm'] = $userUpdatePreferedLangForm->createView();
                $this->gvars['UserUpdateJobForm'] = $userUpdateJobForm->createView();
                $this->gvars['UserUpdateProfileForm'] = $userUpdateProfileForm->createView();
                $this->gvars['UserUpdateUserRolesForm'] = $userUpdateUserRolesForm->createView();
                $this->gvars['UserUploadAvatarForm'] = $userUploadAvatarForm->createView();
                $this->gvars['UserCropAvatarForm'] = $userCropAvatarForm->createView();

                $this->gvars['tabActive'] = $this->getSession()->get('tabActive', 1);
                $this->getSession()->remove('tabActive');



                $this->gvars['pagetitle'] = $this->translate('Pagetitle.user.edit', array('%user%' => $user->getUsername()));
                $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.user.edit.txt', array('%user%' => $user->getUsername()));

                return $this->renderResponse('AllucoAdminBundle:User:edit.html.twig', $this->gvars);
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
            return $this->redirect($this->generateUrl('_admin_user_list'));
        }

        $em = $this->getEntityManager();
        try {
            $user = $em->getRepository('AllucoDataBundle:User')->find($id);

            if (null == $user) {
                $this->flashMsgSession('warning', 'User.edit.notfound');
            } else {
                $userUpdateEmailForm = $this->createForm(new UserUpdateEmailTForm(), $user);
                $userUpdateLockoutForm = $this->createForm(new UserUpdateLockoutTForm(), $user);
                $userUpdatePasswordForm = $this->createForm(new UserUpdatePasswordTForm(), $user);
                $userUpdatePreferedLangForm = $this->createForm(new UserUpdatePreferedLangTForm(), $user);
                $userUpdateJobForm = $this->createForm(new UserUpdateJobTForm(), $user);
                $userUpdateProfileForm = $this->createForm(new UserUpdateProfileTForm(), $user);
                $userUpdateUserRolesForm = $this->createForm(new UserUpdateUserRolesTForm(), $user);
                $userUploadAvatarForm = $this->createForm(new UserUploadAvatarTForm(), $user);
                $userCropAvatarForm = $this->createForm(new UserCropAvatarTForm());



                $this->gvars['tabActive'] = $this->getSession()->get('tabActive', 2);
                $this->getSession()->remove('tabActive');

                $request = $this->getRequest();
                $reqData = $request->request->all();

                if (isset($reqData['UserUpdateEmailForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $userUpdateEmailForm->handleRequest($request);
                    if ($userUpdateEmailForm->isValid()) {
                        $em->persist($user);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('User.edit.success', array('%user%' => $user->getUsername()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($user);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('User.edit.failure', array('%user%' => $user->getUsername()))
                        );
                    }
                } elseif (isset($reqData['UserUpdateLockoutForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $userUpdateLockoutForm->handleRequest($request);
                    if ($userUpdateLockoutForm->isValid()) {
                        $em->persist($user);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('User.edit.success', array('%user%' => $user->getUsername()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($user);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('User.edit.failure', array('%user%' => $user->getUsername()))
                        );
                    }
                } elseif (isset($reqData['UserUpdatePasswordForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $userUpdatePasswordForm->handleRequest($request);
                    if ($userUpdatePasswordForm->isValid()) {
                        $em->persist($user);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('User.edit.success', array('%user%' => $user->getUsername()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($user);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('User.edit.failure', array('%user%' => $user->getUsername()))
                        );
                    }
                } elseif (isset($reqData['UserUpdatePreferedLangForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $userUpdatePreferedLangForm->handleRequest($request);
                    if ($userUpdatePreferedLangForm->isValid()) {
                        $em->persist($user);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('User.edit.success', array('%user%' => $user->getUsername()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($user);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('User.edit.failure', array('%user%' => $user->getUsername()))
                        );
                    }
                } elseif (isset($reqData['UserUpdateJobForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $userUpdateJobForm->handleRequest($request);
                    if ($userUpdateJobForm->isValid()) {
                        $em->persist($user);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('User.edit.success', array('%user%' => $user->getUsername()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($user);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('User.edit.failure', array('%user%' => $user->getUsername()))
                        );
                    }
                } elseif (isset($reqData['UserUpdateProfileForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $userUpdateProfileForm->handleRequest($request);
                    if ($userUpdateProfileForm->isValid()) {
                        $em->persist($user);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('User.edit.success', array('%user%' => $user->getUsername()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($user);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('User.edit.failure', array('%user%' => $user->getUsername()))
                        );
                    }
                } elseif (isset($reqData['UserUpdateUserRolesForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $userUpdateUserRolesForm->handleRequest($request);
                    if ($userUpdateUserRolesForm->isValid()) {
                        $em->persist($user);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('User.edit.success', array('%user%' => $user->getUsername()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($user);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('User.edit.failure', array('%user%' => $user->getUsername()))
                        );
                    }
                } elseif (isset($reqData['UserUploadAvatarForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $userUploadAvatarForm->handleRequest($request);
                    if ($userUploadAvatarForm->isValid()) {
                        $filename = $user->getUsername() . "_" . uniqid() . '.' .$userUploadAvatarForm['avatar']->getData()
                        ->guessExtension();
                        $userUploadAvatarForm['avatar']->getData()->move($this->getParameter('adapter_tmp_files'), $filename);
                        $this->gvars['tmp_avatar'] = $filename;
                        $userCropAvatarForm = $this->createForm(new UserCropAvatarTForm($filename));
                        $this->gvars['UserCropAvatarForm'] = $userCropAvatarForm->createView();
                        $this->gvars['user'] = $user;

                        return $this->renderResponse('AllucoAdminBundle:User:resize_avatar.html.twig', $this->gvars);
                    } else {
                        $this->gvars['UserUploadAvatarForm'] = $userUploadAvatarForm->createView();

                        return $this
                        ->renderResponse('AllucoAdminBundle:User:resize_avatar_error.html.twig', $this->gvars);
                    }
                } elseif (isset($reqData['UserCropAvatarForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $userCropAvatarForm->handleRequest($request);
                    if ($userCropAvatarForm->isValid()) {
                        $filename = $userCropAvatarForm['avatar_tmp']->getData();
                        $path = $this->getParameter('adapter_tmp_files') . '/' . $filename;
                        $x1 = $userCropAvatarForm['x1']->getData();
                        $y1 = $userCropAvatarForm['y1']->getData();
                        $w = $userCropAvatarForm['w']->getData();
                        $h = $userCropAvatarForm['h']->getData();

                        $imagine = new Imagine();
                        $image = $imagine->open($path);
                        /*
                        $widh = $image->getSize()->getWidth();
                        $mult = 1;
                        if ($widh > 400) {
                            $mult = $widh / 400;
                        }
                        if ($widh < 130) {
                            $mult = $widh / 130;
                        }
                        $x1 = round($x1 * $mult);
                        $y1 = round($y1 * $mult);
                        $w = round($w * $mult);
                        $h = round($h * $mult);*/

                        $firstpoint = new Point($x1, $y1);
                        $selbox = new Box($w, $h);
                        $lastbox = new Box(130, 130);
                        $mode = ImageInterface::THUMBNAIL_OUTBOUND;

                        $image->crop($firstpoint, $selbox)->thumbnail($lastbox, $mode)->save($path);

                        $file = new File($path);
                        $avatarDir = $this->getParameter('kernel.root_dir').'/../web/res/avatars';
                        $file->move($avatarDir, $filename);

                        $user->setAvatar($filename);

                        $em->persist($user);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('User.edit.success', array('%user%' => $user->getUsername()))
                        );

                        $this->getSession()->set('tabActive', 1);

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($user);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('User.edit.failure', array('%user%' => $user->getUsername()))
                        );
                    }
                }

                $this->gvars['user'] = $user;
                $this->gvars['UserUpdateEmailForm'] = $userUpdateEmailForm->createView();
                $this->gvars['UserUpdateLockoutForm'] = $userUpdateLockoutForm->createView();
                $this->gvars['UserUpdatePasswordForm'] = $userUpdatePasswordForm->createView();
                $this->gvars['UserUpdatePreferedLangForm'] = $userUpdatePreferedLangForm->createView();
                $this->gvars['UserUpdateJobForm'] = $userUpdateJobForm->createView();
                $this->gvars['UserUpdateProfileForm'] = $userUpdateProfileForm->createView();
                $this->gvars['UserUpdateUserRolesForm'] = $userUpdateUserRolesForm->createView();
                $this->gvars['UserUploadAvatarForm'] = $userUploadAvatarForm->createView();
                $this->gvars['UserCropAvatarForm'] = $userCropAvatarForm->createView();

                $this->gvars['pagetitle'] = $this->translate('Pagetitle.user.edit', array('%user%' => $user->getUsername()));
                $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.user.edit.txt', array('%user%' => $user->getUsername()));

                return $this->renderResponse('AllucoAdminBundle:User:edit.html.twig', $this->gvars);
            }
        } catch (\Exception $e) {
            $logger = $this->getLogger();
            $logger->addCritical($e->getLine().' '.$e->getMessage().' '.$e->getTraceAsString());
        }

        return $this->redirect($urlFrom);

    }
}
