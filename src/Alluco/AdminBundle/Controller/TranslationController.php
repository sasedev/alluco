<?php

namespace Alluco\AdminBundle\Controller;

use Sasedev\Commons\SharedBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Alluco\DataBundle\Entity\Lang;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class TranslationController extends BaseController
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

        $this->gvars['menu_active'] = 'translation';

    }
    /**
     * Display the translation grid.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function gridAction()
    {

        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.translation.list.txt');
        $this->gvars['pagetitle'] = $this->translate('Pagetitle.translation.list');

        $this->gvars['layout'] = $this->getParameter('lexik_translation.base_layout');
        $this->gvars['inputType'] = $this->getParameter('lexik_translation.grid_input_type');
        $this->gvars['locales'] = $this->getManagedLocales();
        $this->gvars['smenu_active'] = 'list';

        return $this->renderResponse('AllucoAdminBundle:Translation:grid.html.twig', $this->gvars);
    }

    /**
     * Add a new trans unit with translation for managed locales.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $handler = $this->get('lexik_translation.form.handler.trans_unit');

        $form = $this->createForm('lxk_trans_unit', $handler->createFormData(), $handler->getFormOptions());

        if ($handler->process($form, $request)) {

            $message = $this->get('translator')->trans('translations.succesfully_added', array(), 'LexikTranslationBundle');

            $this->get('session')->getFlashBag()->add('success', $message);

            $redirectUrl = $form->get('save_add')->isClicked() ? '_admin_translation_new' : '_admin_translation_grid';

            return $this->redirect($this->generateUrl($redirectUrl));
        }

        $this->gvars['layout'] = $this->getParameter('lexik_translation.base_layout');
        $this->gvars['form'] = $form->createView();
        $this->gvars['smenu_active'] = 'add';

        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.translation.add.txt');
        $this->gvars['pagetitle'] = $this->translate('Pagetitle.translation.add');

        return $this->renderResponse('AllucoAdminBundle:Translation:new.html.twig', $this->gvars);
    }

    /**
     * Returns managed locales.
     *
     * @return array
     */
    protected function getManagedLocales()
    {
        $em = $this->getEntityManager();
        $langs = $em->getRepository('AllucoDataBundle:Lang')->getAll();
        $managed_locales = array();
        foreach ($langs as $lang) {
            $managed_locales[] = $lang->getLocale();
        }
        if (\count($managed_locales) == 0) {
            $managed_locales[] = $this->getParameter('locale');
        }
        //return $this->getParameter('lexik_translation.managed_locales');
        return $managed_locales;
    }
}