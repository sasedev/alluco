<?php

namespace Alluco\SecurityBundle\Controller;

use Alluco\SecurityBundle\Form\CropAvatarTForm as UserCropAvatarTForm;
use Alluco\SecurityBundle\Form\UpdateEmailTForm as UserUpdateEmailTForm;
use Alluco\SecurityBundle\Form\UpdatePasswordTForm as UserUpdatePasswordTForm;
use Alluco\SecurityBundle\Form\UpdatePreferedLangTForm as UserUpdatePreferedLangTForm;
use Alluco\SecurityBundle\Form\UpdateJobTForm as UserUpdateJobTForm;
use Alluco\SecurityBundle\Form\UpdateProfileTForm as UserUpdateProfileTForm;
use Alluco\SecurityBundle\Form\UploadAvatarTForm as UserUploadAvatarTForm;
use Imagine\Imagick\Imagine;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
use Imagine\Image\Point;
use Imagine\Image\ImageInterface;
use Sasedev\Commons\SharedBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Security\Core\Encoder\Pbkdf2PasswordEncoder;
use Symfony\Component\Form\FormError;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class ProfileController extends BaseController
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
        $this->gvars['menu_active'] = 'profile';
    }

    public function myProfileAction()
    {


        $em = $this->getEntityManager();
        $root = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/'));
        $this->gvars['root'] = $root;

        $staticpage = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/myProfile'));
        if (null != $staticpage) {
            $this->gvars['pagetitle_txt'] = $staticpage->getMetaTitleTrans();
            $this->gvars['pagetitle'] = $staticpage->getPageTitleTrans();
            $metas = array();
            if (null != $staticpage->getMetaKeywordsTrans()) {
                $meta = array();
                $meta['name'] = 'keywords';
                $meta['content'] = $staticpage->getMetaKeywordsTrans();
                $metas[] = $meta;
            }
            if (null != $staticpage->getMetaDescriptionTrans()) {
                $meta = array();
                $meta['name'] = 'description';
                $meta['content'] = $staticpage->getMetaDescriptionTrans();
                $metas[] = $meta;
            }
            $this->gvars['metas'] = $metas;
        }
        $this->gvars['staticpage'] = $staticpage;

        $banners = $em->getRepository('AllucoDataBundle:Banner')->getAll();
        $this->gvars['banners'] = $banners;

        $news = $em->getRepository('AllucoDataBundle:Sitenew')->getLimited(1);
        $this->gvars['news'] = $news;

        $groups = $em->getRepository('AllucoDataBundle:Product')->getRoots();
        $this->gvars['groups'] = $groups;

        $sc = $this->getSecurityContext();
        $user = $sc->getToken()->getUser();

        $userUpdateProfileForm = $this->createForm(new UserUpdateProfileTForm(), $user);
        $userUpdatePreferedLangForm = $this->createForm(new UserUpdatePreferedLangTForm(), $user);
        $userUpdateJobForm = $this->createForm(new UserUpdateJobTForm(), $user);
        $userUpdateEmailForm = $this->createForm(new UserUpdateEmailTForm(), $user);
        $userUpdatePasswordForm = $this->createForm(new UserUpdatePasswordTForm(), $user);
        $userUploadAvatarForm = $this->createForm(new UserUploadAvatarTForm(), $user);
        $userCropAvatarForm = $this->createForm(new UserCropAvatarTForm());

        $this->gvars['user'] = $user;
        $this->gvars['UserUpdateProfileForm'] = $userUpdateProfileForm->createView();
        $this->gvars['UserUpdatePreferedLangForm'] = $userUpdatePreferedLangForm->createView();
        $this->gvars['UserUpdateJobForm'] = $userUpdateJobForm->createView();
        $this->gvars['UserUpdateEmailForm'] = $userUpdateEmailForm->createView();
        $this->gvars['UserUpdatePasswordForm'] = $userUpdatePasswordForm->createView();
        $this->gvars['UserUploadAvatarForm'] = $userUploadAvatarForm->createView();
        $this->gvars['UserCropAvatarForm'] = $userCropAvatarForm->createView();

        $quotation = $this->getSession()->get('quotation', 0);
        if ($quotation != 0) {
            $this->gvars['quotation'] = $quotation;
            $this->gvars['tabActive'] = 3;
        } else {
            $this->gvars['tabActive'] = $this->getSession()->get('tabActive', 1);
        }
        $this->getSession()->remove('tabActive');
        $this->getSession()->remove('quotation');

        return $this->renderResponse('AllucoSecurityBundle:Profile:profile.default.html.twig', $this->gvars);
    }

    public function myProfilePostAction()
    {
        $sc = $this->getSecurityContext();
        $user = $sc->getToken()->getUser();
        $oldDbpass = $user->getPassword();



        $em = $this->getEntityManager();
        $root = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/'));
        $this->gvars['root'] = $root;

        $staticpage = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/myProfile'));
        if (null != $staticpage) {
            $this->gvars['pagetitle_txt'] = $staticpage->getMetaTitleTrans();
            $this->gvars['pagetitle'] = $staticpage->getPageTitleTrans();
            $metas = array();
            if (null != $staticpage->getMetaKeywordsTrans()) {
                $meta = array();
                $meta['name'] = 'keywords';
                $meta['content'] = $staticpage->getMetaKeywordsTrans();
                $metas[] = $meta;
            }
            if (null != $staticpage->getMetaDescriptionTrans()) {
                $meta = array();
                $meta['name'] = 'description';
                $meta['content'] = $staticpage->getMetaDescriptionTrans();
                $metas[] = $meta;
            }
            $this->gvars['metas'] = $metas;
        }
        $this->gvars['staticpage'] = $staticpage;

        $banners = $em->getRepository('AllucoDataBundle:Banner')->getAll();
        $this->gvars['banners'] = $banners;

        $news = $em->getRepository('AllucoDataBundle:Sitenew')->getLimited(1);
        $this->gvars['news'] = $news;

        $groups = $em->getRepository('AllucoDataBundle:Product')->getRoots();
        $this->gvars['groups'] = $groups;

        $userUpdateProfileForm = $this->createForm(new UserUpdateProfileTForm(), $user);
        $userUpdatePreferedLangForm = $this->createForm(new UserUpdatePreferedLangTForm(), $user);
        $userUpdateJobForm = $this->createForm(new UserUpdateJobTForm(), $user);
        $userUpdateEmailForm = $this->createForm(new UserUpdateEmailTForm(), $user);
        $userUpdatePasswordForm = $this->createForm(new UserUpdatePasswordTForm(), $user);
        $userUploadAvatarForm = $this->createForm(new UserUploadAvatarTForm(), $user);
        $userCropAvatarForm = $this->createForm(new UserCropAvatarTForm());

        $this->gvars['tabActive'] = $this->getSession()->get('tabActive', 2);
        $this->getSession()->remove('tabActive');

        $request = $this->getRequest();
        $reqData = $request->request->all();

        if (isset($reqData['UserUpdateEmailForm'])) {
            $this->gvars['tabActive'] = 2;
            $this->getSession()->set('tabActive', 2);
            $userUpdateEmailForm->bind($request);
            if ($userUpdateEmailForm->isValid()) {
                $em->persist($user);
                $em->flush();
                $this->flashMsgSession('success', $this->translate('Profile.edit.success'));

                return $this->redirect($this->generateUrl('_security_profile'));
            } else {
                $em->refresh($user);

                $this->flashMsgSession('error', $this->translate('Profile.edit.failure'));
            }
        } elseif (isset($reqData['UserUpdatePasswordForm'])) {
            $this->gvars['tabActive'] = 2;
            $this->getSession()->set('tabActive', 2);
            $userUpdatePasswordForm->bind($request);
            if ($userUpdatePasswordForm->isValid()) {
                $oldPassword = $userUpdatePasswordForm['oldPassword']->getData();
                $encoder = new Pbkdf2PasswordEncoder('sha512', true, 1000);
                $oldpassEncoded = $encoder->encodePassword($oldPassword, $user->getSalt());
                if ($oldpassEncoded != $oldDbpass) {
                    $formError = new FormError($this->translate('User.oldPassword.incorrect', array(), 'validators'));

                    $userUpdatePasswordForm['oldPassword']->addError($formError);
                    $this->flashMsgSession('error', $this->translate('Profile.edit.failure'));
                } else {
                    $em->persist($user);
                    $em->flush();
                    $this->flashMsgSession('success', $this->translate('Profile.edit.success'));

                    return $this->redirect($this->generateUrl('_security_profile'));
                }
            } else {
                $em->refresh($user);

                $this->flashMsgSession('error', $this->translate('Profile.edit.failure'));
            }
        } elseif (isset($reqData['UserUpdatePreferedLangForm'])) {
            $this->gvars['tabActive'] = 2;
            $this->getSession()->set('tabActive', 2);
            $userUpdatePreferedLangForm->bind($request);
            if ($userUpdatePreferedLangForm->isValid()) {
                $em->persist($user);
                $em->flush();
                $this->flashMsgSession('success', $this->translate('Profile.edit.success'));

                return $this->redirect($this->generateUrl('_security_profile'));
            } else {
                $em->refresh($user);

                $this->flashMsgSession('error', $this->translate('Profile.edit.failure'));
            }
        } elseif (isset($reqData['UserUpdateJobForm'])) {
            $this->gvars['tabActive'] = 2;
            $this->getSession()->set('tabActive', 2);
            $userUpdateJobForm->bind($request);
            if ($userUpdateJobForm->isValid()) {
                $em->persist($user);
                $em->flush();
                $this->flashMsgSession('success', $this->translate('Profile.edit.success'));

                return $this->redirect($this->generateUrl('_security_profile'));
            } else {
                $em->refresh($user);

                $this->flashMsgSession('error', $this->translate('Profile.edit.failure'));
            }
        } elseif (isset($reqData['UserUpdateProfileForm'])) {
            $this->gvars['tabActive'] = 2;
            $this->getSession()->set('tabActive', 2);
            $userUpdateProfileForm->bind($request);
            if ($userUpdateProfileForm->isValid()) {
                $em->persist($user);
                $em->flush();
                $this->flashMsgSession('success', $this->translate('Profile.edit.success'));

                return $this->redirect($this->generateUrl('_security_profile'));
            } else {
                $em->refresh($user);

                $this->flashMsgSession('error', $this->translate('Profile.edit.failure'));
            }
        } elseif (isset($reqData['UserUploadAvatarForm'])) {
            $this->gvars['tabActive'] = 2;
            $this->getSession()->set('tabActive', 2);
            $userUploadAvatarForm->bind($request);
            if ($userUploadAvatarForm->isValid()) {
                $filename = $user->getUsername() . "_" . uniqid() . '.' . $userUploadAvatarForm['avatar']->getData()->guessExtension();
                $userUploadAvatarForm['avatar']->getData()->move($this->getParameter('adapter_tmp_files'), $filename);
                $this->gvars['tmp_avatar'] = $filename;
                $userCropAvatarForm = $this->createForm(new UserCropAvatarTForm($filename));
                $this->gvars['UserCropAvatarForm'] = $userCropAvatarForm->createView();
                $this->gvars['user'] = $user;

                return $this->renderResponse('AllucoSecurityBundle:Profile:resize_avatar.html.twig', $this->gvars);
            } else {
                $this->gvars['UserUploadAvatarForm'] = $userUploadAvatarForm->createView();

                return $this->renderResponse('AllucoSecurityBundle:Profile:resize_avatar_error.html.twig', $this->gvars);
            }
        } elseif (isset($reqData['UserCropAvatarForm'])) {
            $this->gvars['tabActive'] = 2;
            $this->getSession()->set('tabActive', 2);
            $userCropAvatarForm->bind($request);
            if ($userCropAvatarForm->isValid()) {
                $filename = $userCropAvatarForm['avatar_tmp']->getData();
                $path = $this->getParameter('adapter_tmp_files') . '/' . $filename;
                $x1 = $userCropAvatarForm['x1']->getData();
                $y1 = $userCropAvatarForm['y1']->getData();
                $w = $userCropAvatarForm['w']->getData();
                $h = $userCropAvatarForm['h']->getData();

                $imagine = new Imagine();
                $image = $imagine->open($path);

                $firstpoint = new Point($x1, $y1);
                $selbox = new Box($w, $h);
                $lastbox = new Box(130, 130);
                $mode = ImageInterface::THUMBNAIL_OUTBOUND;

                $image->crop($firstpoint, $selbox)
                    ->thumbnail($lastbox, $mode)
                    ->save($path);

                $file = new File($path);
                $avatarDir = $this->getParameter('kernel.root_dir') . '/../web/res/avatars';
                $file->move($avatarDir, $filename);

                $user->setAvatar($filename);

                $em->persist($user);
                $em->flush();
                $this->flashMsgSession('success', $this->translate('Profile.edit.success'));

                $this->getSession()->set('tabActive', 1);

                return $this->redirect($this->generateUrl('_security_profile'));
            } else {
                $em->refresh($user);

                $this->flashMsgSession('error', $this->translate('Profile.edit.failure'));
            }
        }

        $this->gvars['user'] = $user;
        $this->gvars['UserUpdateProfileForm'] = $userUpdateProfileForm->createView();
        $this->gvars['UserUpdatePreferedLangForm'] = $userUpdatePreferedLangForm->createView();
        $this->gvars['UserUpdateJobForm'] = $userUpdateJobForm->createView();
        $this->gvars['UserUpdateEmailForm'] = $userUpdateEmailForm->createView();
        $this->gvars['UserUpdatePasswordForm'] = $userUpdatePasswordForm->createView();
        $this->gvars['UserUploadAvatarForm'] = $userUploadAvatarForm->createView();
        $this->gvars['UserCropAvatarForm'] = $userCropAvatarForm->createView();


        return $this->renderResponse('AllucoSecurityBundle:Profile:profile.default.html.twig', $this->gvars);
    }
}