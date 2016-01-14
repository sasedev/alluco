<?php

namespace Alluco\SecurityBundle\Controller;

use Alluco\DataBundle\Entity\User;
use Alluco\SecurityBundle\Form\LoginTForm;
use Alluco\SecurityBundle\Form\LostPasswordTForm;
use Sasedev\Commons\SharedBundle\Controller\BaseController;
use Symfony\Component\Security\Core\Security;
use Alluco\SecurityBundle\Form\RegisterTForm;
use Alluco\DataBundle\Entity\Role;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class SecurityController extends BaseController
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

    /**
     * login Action
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse Ambigous
     *         Response>
     */
    public function loginAction()
    {
        // si l'utilisateur est déja connecté on le redirige vers sa page de
        // profile
        /*if ($this->hasRole('IS_AUTHENTICATED_FULLY')) {
            return $this->redirect($this->generateUrl('_security_profile'));
        } //*/

        $em = $this->getEntityManager();
        $root = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/'));
        $this->gvars['root'] = $root;

        $staticpage = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/login'));
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
        $referer = $this->getReferer();
        $request = $this->getRequest();
        $session = $this->getSession();

        $targetPath = $session->get('_security.main.target_path');

        //$logger = $this->getLogger();
        //$logger->addError($targetPath);

        $baseUrl =  $request->getSchemeAndHttpHost();

        if(\stripos($targetPath, $baseUrl.'/doc') === 0 || \stripos($targetPath, '/doc') === 0  || \stripos($targetPath, $baseUrl.'/prod') === 0 || \stripos($targetPath, '/prod') === 0) {
            $this->flashMsgSession('warning', $this->translate('security.docdownload'));
        }

        if(\stripos($targetPath, $baseUrl.'/quotation') === 0 || \stripos($targetPath, '/quotation') === 0) {
            $this->flashMsgSession('warning', $this->translate('security.quotation'));
        }

        if ($request->attributes->has(Security::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(Security::AUTHENTICATION_ERROR);
            $request->attributes->remove(Security::AUTHENTICATION_ERROR);
            $msg = $this->translate($error->getMessage());
            $this->flashMsgSession('error', $msg);
        } elseif ($session->has(Security::AUTHENTICATION_ERROR)) {
            $error = $session->get(Security::AUTHENTICATION_ERROR);
            $session->remove(Security::AUTHENTICATION_ERROR);
            $msg = $this->translate($error->getMessage());
            $this->flashMsgSession('error', $msg);
        }

        $lastUsername = $session->get('_security.last_username');


        $loginForm = $this->createForm(new LoginTForm());

        $loginForm->get('username')->setData($lastUsername);
        $loginForm->get('target_path')->setData($referer);

        $this->gvars['LoginForm'] = $loginForm->createView();

        return $this->renderResponse('AllucoSecurityBundle:Security:login.html.twig', $this->gvars);
    }

    /**
     * lostPassword Action
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse Ambigous
     *         Response>
     */
    public function lostPasswordAction()
    {
        if ($this->hasRole('IS_AUTHENTICATED_FULLY')) {
            return $this->redirect($this->generateUrl('_security_profile'));
        }

        $em = $this->getEntityManager();
        $root = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/'));
        $this->gvars['root'] = $root;

        $staticpage = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/lostPassword'));
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

        $lostPasswordForm = $this->createForm(new LostPasswordTForm());
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $lostPasswordForm->bind($request);
            if ($lostPasswordForm->isValid()) {
                $username = $lostPasswordForm['username']->getData();
                $em = $this->getEntityManager();
                $user = null;
                $user = $em->getRepository('AllucoDataBundle:User')->findOneBy(array('username' => $username));

                if (null != $user) {
                    $now = new \DateTime('now');
                    $nexthour = new \DateTime();
                    $nexthour->setTimestamp(strtotime('+1 hour'));
                    if (null == $user->getRecoveryExpiration() || $user->getRecoveryExpiration() < $now) {
                        $user->setRecoveryExpiration($nexthour);
                        $user->setRecoveryCode(User::generateRandomChar(20));
                        $em->persist($user);
                        $em->flush();

                        $mvars = array();
                        $mvars['user'] = $user;
                        $mvars['url'] = $this->generateUrl('_security_lost_genpassword',
                            array('id' => $user->getId(), 'code' => $user->getRecoveryCode()), true);

                        $from = $this->getParameter('mail_from');
                        $fromName = $this->getParameter('mail_from_name');
                        $subject = $this->translate('_mail.lostPassword.subject', array(), 'messages');
                        $message = \Swift_Message::newInstance()->setFrom($from, $fromName)
                            ->setTo($user->getEmail(), $user->getFullname())
                            ->setSubject($subject)
                            ->setBody(
                            $this->renderView('AllucoSecurityBundle:Mail:getPasswordResetLink.html.twig', $mvars),
                            'text/html');

                        $this->sendmail($message);

                        $this->flashMsgSession('success',
                            $this->translate('_security.lostPassword.mail.newpassSent',
                                array('%mail%' => $user->getEmail())));

                        return $this->redirect($this->generateUrl('_security_login'));
                    } else {
                        $this->flashMsgSession('error', $this->translate('_security.lostPassword.alreadySent'));
                    }
                } else {
                    $this->flashMsgSession('error',
                        $this->translate('_security.lostPassword.notfound', array('%username%' => $username)));
                }
            }
        }
        $this->gvars['LostPasswordForm'] = $lostPasswordForm->createView();

        return $this->renderResponse('AllucoSecurityBundle:Security:lostPassword.html.twig', $this->gvars);
    }

    /**
     * lostPassword Action
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse Ambigous
     *         Response>
     */
    public function registerAction()
    {
        if ($this->hasRole('IS_AUTHENTICATED_FULLY')) {
            return $this->redirect($this->generateUrl('_security_profile'));
        }

        $em = $this->getEntityManager();
        $root = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/'));
        $this->gvars['root'] = $root;

        $staticpage = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/register'));
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



        $user = new User();
        $registerForm = $this->createForm(new RegisterTForm(), $user);
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $registerForm->bind($request);
            if ($registerForm->isValid()) {
                $role = $em->getRepository('AllucoDataBundle:Role')->findOneBy(array('name' => 'ROLE_USER'));
                if (null == $role) {
                    $role = new Role();
                    $role->setName('ROLE_USER');
                    $role->setDescription('Utilisateur Simple');

                    $em->persist($role);
                }
                $user->addUserRole($role);
                $role->addUser($user);

                $em->persist($role);
                $em->persist($user);
                $em->flush();
                $this->flashMsgSession('success', $this->translate('_security.register.ok', array('%username%' => $user->getUsername())));
                return $this->redirect($this->generateUrl('_security_login'));
            } else {
                $this->flashMsgSession('error', $this->translate('_security.register.already', array('%username%' => $user->getUsername())));
            }
        }

        $this->gvars['RegisterForm'] = $registerForm->createView();

        return $this->renderResponse('AllucoSecurityBundle:Security:register.html.twig', $this->gvars);
    }

    /**
     * genNewPassword Action
     *
     * @param guid $id
     * @param string $code
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function genNewPasswordAction($id, $code)
    {
        if ($this->hasRole('IS_AUTHENTICATED_FULLY')) {
            return $this->redirect($this->generateUrl('_security_profile'));
        }
        $em = $this->getEntityManager();
        try {
            $user = null;
            $user = $em->getRepository('AllucoDataBundle:User')->find($id);

            if (null != $user) {
                $now = new \DateTime('now');
                if (null == $user->getRecoveryExpiration() || $user->getRecoveryExpiration() < $now) {
                    $this->flashMsgSession('error', $this->translate('_security.genNewPassword.errorparams2'));
                } elseif ($user->getRecoveryCode() != $code) {
                    $this->flashMsgSession('error', $this->translate('_security.genNewPassword.errorparams3'));
                } else {
                    $user->setSalt(md5(uniqid(null, true)));
                    $user->setClearPassword(
                        User::generateRandomChar(8, 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'));
                    $user->setRecoveryExpiration(null);
                    $user->setRecoveryCode(null);
                    $em->persist($user);
                    $em->flush();
                    $mvars = array();
                    $mvars['user'] = $user;
                    $from = $this->getParameter('mail_from');
                    $fromName = $this->getParameter('mail_from_name');
                    $subject = $this->translate('_mail.genNewPassword.subject', array(), 'messages');

                    $message = \Swift_Message::newInstance()->setFrom($from, $fromName)
                        ->setTo($user->getEmail(), $user->getFullname())
                        ->setSubject($subject)
                        ->setBody($this->renderView('AllucoSecurityBundle:Mail:genNewPassword.html.twig', $mvars),
                        'text/html');

                    $this->sendmail($message);

                    $this->flashMsgSession('success', $this->translate('_security.genNewPassword.ok'));
                }
            } else {
                $this->flashMsgSession('error', $this->translate('_security.genNewPassword.errorparams1'));
            }
        } catch (\Exception $e) {
            $logger = $this->getLogger();
            $logger->error($e->getMessage());
            $this->flashMsgSession('error', $this->translate('_security.genNewPassword.errorparams4'));
        }

        return $this->redirect($this->generateUrl('_security_login'));
    }

    /**
     * whoamiAction
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function whoamiAction()
    {
        $sc = $this->getSecurityContext();
        $user = $sc->getToken()->getUser();
        $this->gvars['user'] = $user;

        return $this->renderResponse('AllucoSecurityBundle:Profile:whoami.html.twig', $this->gvars);
    }
}