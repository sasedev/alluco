<?php

namespace Alluco\AdminBundle\Controller;

use Sasedev\Commons\SharedBundle\Controller\BaseController;

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

    public function listAction()
    {
        $em = $this->getEntityManager();
        $contacts = $em->getRepository('AllucoDataBundle:Contact')->getAll();
        $this->gvars['contacts'] = $contacts;

        $this->gvars['smenu_active'] = 'list';
        $this->gvars['pagetitle'] = $this->translate('Pagetitle.contact.list');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.contact.list.txt');
        return $this->renderResponse('AllucoAdminBundle:Contact:list.html.twig', $this->gvars);
    }

    public function deleteAction($id)
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_admin_contact_list');
        }
        $em = $this->getEntityManager();
        try {
            $contact = $em->getRepository('AllucoDataBundle:Contact')->find($id);

            if (null == $contact) {
                $this->flashMsgSession('warning', 'Contact.delete.notfound');
            } else {
                $em->remove($contact);
                $em->flush();

                $this->flashMsgSession(
                    'success',
                    $this->translate('Contact.delete.success', array('%contact%' => $contact->getId()))
                );
            }
        } catch (\Exception $e) {
            $logger = $this->getLogger();
            $logger->addCritical($e->getLine().' '.$e->getMessage().' '.$e->getTraceAsString());

            $this->flashMsgSession('error', $this->translate('Contact.delete.failure'));
        }

        return $this->redirect($urlFrom);

    }

    public function editGetAction($id)
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_admin_contact_list');
        }

        $em = $this->getEntityManager();
        try {
            $contact = $em->getRepository('AllucoDataBundle:Contact')->find($id);

            if (null == $contact) {
                $this->flashMsgSession('warning', 'Contact.edit.notfound');
            } else {
                $this->gvars['contact'] = $contact;

                $this->gvars['tabActive'] = $this->getSession()->get('tabActive', 1);
                $this->getSession()->remove('tabActive');



                $this->gvars['pagetitle'] = $this->translate('Pagetitle.contact.edit', array('%contact%' => $contact->getId()));
                $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.contact.edit.txt', array('%contact%' => $contact->getId()));

                return $this->renderResponse('AllucoAdminBundle:Contact:edit.html.twig', $this->gvars);
            }
        } catch (\Exception $e) {
            $logger = $this->getLogger();
            $logger->addCritical($e->getLine().' '.$e->getMessage().' '.$e->getTraceAsString());
        }

        return $this->redirect($urlFrom);
    }

}