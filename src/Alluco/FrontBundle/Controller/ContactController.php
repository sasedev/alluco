<?php

namespace Alluco\FrontBundle\Controller;

use Sasedev\Commons\SharedBundle\Controller\BaseController;
use Alluco\DataBundle\Entity\Contact;
use Alluco\FrontBundle\Form\ContactTForm;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class ContactController extends BaseController
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

        $this->gvars['menu_active'] = 'contact';

    }

    public function indexAction()
    {

        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_front_contact');
        }

        $em = $this->getEntityManager();
        $root = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/'));
        $this->gvars['root'] = $root;

        $staticpage = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/contact'));
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

        $contact = new Contact();
        $contactForm = $this->createForm(new ContactTForm(), $contact);


        $request = $this->getRequest();
        $reqData = $request->request->all();
        if (isset($reqData['ContactForm'])) {
            $contactForm->bind($request);
            if ($contactForm->isValid()) {
                $em->persist($contact);
                $em->flush();

                $mailtos = $this->getParameter('mailtos');

                $from = $this->getParameter('mail_from');
                $fromName = $this->getParameter('mail_from_name');

                $name = $contact->getFirstName().' '.$contact->getLastName();
                $email = $contact->getEmail();
                $subject = $contact->getSubject();
                $body = '<p>Prénom : <b>'.$contact->getFirstName().'</b><br>';
                $body .= 'Nom : <b>'.$contact->getLastName().'</b><br>';
                $body .= 'Email : <b>'.$contact->getEmail().'</b><br>';
                $body .= 'Tel : <b>'.$contact->getPhone().'</b><br>';
                $body .= 'Profession : <b>'.$contact->getJob()->getName().'</b><br>';
                $body .= 'Entreprise : <b>'.$contact->getCompany().'</b><br>';
                $body .= 'Message :</p>';
                $body .= $contact->getMsg();

                foreach ($mailtos as $mailto) {
                    $message = \Swift_Message::newInstance()->setFrom($from, $fromName)
                    ->addTo($mailto['email'], $mailto['name'])
                    ->addReplyTo($email, $name)
                    ->setSubject($subject)->setBody(
                        $body,
                        'text/html'
                    );

                    $this->sendmail($message);
                }


                $this->flashMsgSession(
                    'success',
                    'contact.send.success'
                );

                return $this->redirect($urlFrom);

            } else {
                $this->flashMsgSession(
                    'error',
                    'contact.send.failure'
                );
            }
        }

        $this->gvars['ContactForm'] = $contactForm->createView();


        return $this->renderResponse('AllucoFrontBundle:Contact:index.html.twig', $this->gvars);
    }
}