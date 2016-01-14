<?php

namespace Alluco\FrontBundle\Controller;

use Sasedev\Commons\SharedBundle\Controller\BaseController;
use Alluco\FrontBundle\Form\Quotation\F50ALTForm;
use Alluco\FrontBundle\Form\Quotation\F50ALOrderTForm;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Alluco\DataBundle\Entity\Quotation;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class QuotationController extends BaseController
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

        $this->gvars['menu_active'] = 'quotation';

    }

    public function indexAction()
    {

        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_front_quotation');
        }

        $em = $this->getEntityManager();
        $root = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/'));
        $this->gvars['root'] = $root;

        $staticpage = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/quotations'));
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

        $availableQuotRoutes = [];
        foreach ($this->get('router')->getRouteCollection()->all() as $name => $route) {
            $route = $route->compile();
            if( strpos($name, "_front_quotation_") === 0 ){
                $availableQuotRoutes[] = ["name" => $name, "variables" => $route->getVariables()];
            }
        }

        $this->gvars['quotation_routes'] = $availableQuotRoutes;


        return $this->renderResponse('AllucoFrontBundle:Quotation:index.html.twig', $this->gvars);
    }

    public function f50ALbakAction()
    {

        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_front_quotation');
        }

        $em = $this->getEntityManager();
        $root = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/'));
        $this->gvars['root'] = $root;
        $rootquot = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/quotations'));
        $this->gvars['rootquot'] = $rootquot;
        $staticpage = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/quotation/F50_Accord_L'));
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

        $quotForm = $this->createForm(new F50ALTForm());

        $quotOrderForm = $this->createForm(new F50ALOrderTForm());

        $showform = true;

        $height = 0;
        $widthLR = 0;
        $widthC = 0;
        $prof = 0;

        $request = $this->getRequest();
        $reqData = $request->request->all();
        if (isset($reqData['F50ALForm'])) {
            $quotForm->handleRequest($request);

            $height = $quotForm['height']->getData();
            $widthLR = $quotForm['widthLR']->getData();
            $widthC = $quotForm['widthC']->getData();
            $prof = $quotForm['prof']->getData();
            $width = $widthC + $widthLR;
            if ($quotForm->isValid()) {
                $showform = false;

                $quotOrderForm = $this->createForm(new F50ALOrderTForm($height, $widthLR, $widthC, $prof));

                $nb = \floatval(\floatval($width)/600);
                //$this->gvars['prof'] = \floatval(\floatval($prof)/100);

                $m1 = \round(\floatval(\floatval($widthC)/100))+1;
                $m2 = \round(\floatval(\floatval($widthLR)/100))+1;

                $co=($m1+$m2)*($height-10);
                $nbr= \intval($m1+$m2);



                //Hauteur du Gardes Corps: "+$height+"mètre
                //Largeur du Gardes Corps: "+ $width+"mètre");

                //Profilé
                //Réference / Nom de produit // Quantité // Dimenssion // Nombre de barre (6 Mètre) //

                //F50-200 Main Courante (600Cm) // (int)Math.ceil($nb) // $width mètres // (int)Math.ceil($nb) //
                $profil1Name = 'Quotation.f50AL.profil.1';
                $profil1Qte = \intval(\ceil($nb));
                $profil1Dim = $width;
                $profil1Nb = \intval(\ceil($nb));
                //F50-100 Colonne // (int)Math.ceil($nbr) // <%=co/100 %>mètre // (int)Math.ceil(co/600) //
                $profil2Name = 'Quotation.f50AL.profil.2';
                $profil2Qte = \intval(\ceil($nbr));
                $profil2Dim = \floatval($co/100);
                $profil2Nb = \intval(\ceil($co/600));
                //F50-300 Profilé (600Cm) | F50-301 Profilé (600Cm) // (int)prof // ((int)prof*l)/100%>mètre< // (int)Math.ceil(((int)prof*l)/600) //
                $profil3Qte = \intval($prof);
                $profil3Dim = \floatval(\intval($prof*$width)/100);
                $profil3Nb = \intval(\ceil((\intval($prof*$width))/600));

                // Accessoires
                //Réference / Nom de produit // Quantité //
                //4112 pied de support de poteau F50-100 | 4121 pied de support de poteau F50-100 // nbr //
                $access1Qte = $nbr;
                //4314 support main courante // nbr //
                $access2Name = 'Quotation.f50AL.access.2';
                $access2Qte = $nbr;
                //4312  jonction de poteau F50-100+profilé // (int)prof*nbr //
                $access3Name = 'Quotation.f50AL.access.2';
                $access3Qte = \intval($prof*$nbr);
                //4228 90° jonction de profilé | 4229 135° jonction de profilé | 4302  jonction coudée de profilé // (int)prof //
                $access4Qte = \intval($prof);
                //4329 jonction réglable de main courante // 1 //
                $access5Name = 'Quotation.f50AL.access.2';
                $access5Qte = 1;
                //4438 Bouchon de profilé F50-300 | 4435 Bouchon de profilé F50-301 // (int)prof*2 //
                $access6Qte = \intval($prof*2);
                //4509Z Couvre joint de main courante avec bouchon | 4434 Bouchon de main courante // 2 //
                $access7Qte = 2;



                $this->gvars['height'] = \floatval(\floatval($height)/100);
                $this->gvars['width'] = \floatval(\floatval($width)/100);
                $this->gvars['profil1Name'] = $profil1Name;
                $this->gvars['profil1Qte'] = $profil1Qte;
                $this->gvars['profil1Dim'] = $profil1Dim;
                $this->gvars['profil1Nb'] = $profil1Nb;
                $this->gvars['profil2Name'] = $profil2Name;
                $this->gvars['profil2Qte'] = $profil2Qte;
                $this->gvars['profil2Dim'] = $profil2Dim;
                $this->gvars['profil2Nb'] = $profil2Nb;
                $this->gvars['profil3Qte'] = $profil3Qte;
                $this->gvars['profil3Dim'] = $profil3Dim;
                $this->gvars['profil3Nb'] = $profil3Nb;
                $this->gvars['access1Qte'] = $access1Qte;
                $this->gvars['access2Name'] = $access2Name;
                $this->gvars['access2Qte'] = $access2Qte;
                $this->gvars['access3Name'] = $access3Name;
                $this->gvars['access3Qte'] = $access3Qte;
                $this->gvars['access4Qte'] = $access4Qte;
                $this->gvars['access5Name'] = $access5Name;
                $this->gvars['access5Qte'] = $access5Qte;
                $this->gvars['access6Qte'] = $access6Qte;
                $this->gvars['access7Qte'] = $access7Qte;

                $this->flashMsgSession(
                    'success',
                    'Calcul effectué'
                );
            } else {
                $showform = true;
                $this->gvars['height'] = \floatval(\floatval($height)/100);
                $this->gvars['width'] = \floatval(\floatval($width)/100);

                $this->flashMsgSession(
                    'error',
                    'Valeurs invalides'
                );
            }
        } elseif (isset($reqData['F50ALOrderForm'])) {

            $height = $quotForm['height']->getData();
            $widthLR = $quotForm['widthLR']->getData();
            $widthC = $quotForm['widthC']->getData();
            $prof = $quotForm['prof']->getData();
            $width = $widthC + $widthLR;
            $quotOrderForm->handleRequest($request);
            $showform = false;
            if ($quotOrderForm->isValid()) {



                $width = $widthC + $widthLR;

                $nb = \floatval(\floatval($width)/600);
                //$this->gvars['prof'] = \floatval(\floatval($prof)/100);

                $m1 = \round(\floatval(\floatval($widthC)/100))+1;
                $m2 = \round(\floatval(\floatval($widthLR)/100))+1;

                $co=($m1+$m2)*($height-10);
                $nbr= \intval($m1+$m2);



                //Hauteur du Gardes Corps: "+$height+"mètre
                //Largeur du Gardes Corps: "+ $width+"mètre");

                //Profilé
                //Réference / Nom de produit // Quantité // Dimenssion // Nombre de barre (6 Mètre) //

                //F50-200 Main Courante (600Cm) // (int)Math.ceil($nb) // $width mètres // (int)Math.ceil($nb) //
                $profil1Name = 'Quotation.f50AL.profil.1';
                $profil1Qte = \intval(\ceil($nb));
                $profil1Dim = $width;
                $profil1Nb = \intval(\ceil($nb));
                //F50-100 Colonne // (int)Math.ceil($nbr) // <%=co/100 %>mètre // (int)Math.ceil(co/600) //
                $profil2Name = 'Quotation.f50AL.profil.2';
                $profil2Qte = \intval(\ceil($nbr));
                $profil2Dim = \floatval($co/100);
                $profil2Nb = \intval(\ceil($co/600));
                //F50-300 Profilé (600Cm) | F50-301 Profilé (600Cm) // (int)prof // ((int)prof*l)/100%>mètre< // (int)Math.ceil(((int)prof*l)/600) //
                $profil3Qte = \intval($prof);
                $profil3Dim = \floatval(\intval($prof*$width)/100);
                $profil3Nb = \intval(\ceil((\intval($prof*$width))/600));

                // Accessoires
                //Réference / Nom de produit // Quantité //
                //4112 pied de support de poteau F50-100 | 4121 pied de support de poteau F50-100 // nbr //
                $access1Qte = $nbr;
                //4314 support main courante // nbr //
                $access2Name = 'Quotation.f50AL.access.2';
                $access2Qte = $nbr;
                //4312  jonction de poteau F50-100+profilé // (int)prof*nbr //
                $access3Name = 'Quotation.f50AL.access.2';
                $access3Qte = \intval($prof*$nbr);
                //4228 90° jonction de profilé | 4229 135° jonction de profilé | 4302  jonction coudée de profilé // (int)prof //
                $access4Qte = \intval($prof);
                //4329 jonction réglable de main courante // 1 //
                $access5Name = 'Quotation.f50AL.access.2';
                $access5Qte = 1;
                //4438 Bouchon de profilé F50-300 | 4435 Bouchon de profilé F50-301 // (int)prof*2 //
                $access6Qte = \intval($prof*2);
                //4509Z Couvre joint de main courante avec bouchon | 4434 Bouchon de main courante // 2 //
                $access7Qte = 2;



                $this->gvars['height'] = \floatval(\floatval($height)/100);
                $this->gvars['width'] = \floatval(\floatval($width)/100);
                $this->gvars['profil1Name'] = $profil1Name;
                $this->gvars['profil1Qte'] = $profil1Qte;
                $this->gvars['profil1Dim'] = $profil1Dim;
                $this->gvars['profil1Nb'] = $profil1Nb;
                $this->gvars['profil2Name'] = $profil2Name;
                $this->gvars['profil2Qte'] = $profil2Qte;
                $this->gvars['profil2Dim'] = $profil2Dim;
                $this->gvars['profil2Nb'] = $profil2Nb;
                $this->gvars['profil3Name'] = $quotOrderForm['profil3Name']->getData();
                $this->gvars['profil3Qte'] = $profil3Qte;
                $this->gvars['profil3Dim'] = $profil3Dim;
                $this->gvars['profil3Nb'] = $profil3Nb;
                $this->gvars['access1Name'] = $quotOrderForm['access1Name']->getData();
                $this->gvars['access1Qte'] = $access1Qte;
                $this->gvars['access2Name'] = $access2Name;
                $this->gvars['access2Qte'] = $access2Qte;
                $this->gvars['access3Name'] = $access3Name;
                $this->gvars['access3Qte'] = $access3Qte;
                $this->gvars['access4Name'] = $quotOrderForm['access4Name']->getData();
                $this->gvars['access4Qte'] = $access4Qte;
                $this->gvars['access5Name'] = $access5Name;
                $this->gvars['access5Qte'] = $access5Qte;
                $this->gvars['access6Name'] = $quotOrderForm['access6Name']->getData();
                $this->gvars['access6Qte'] = $access6Qte;
                $this->gvars['access7Name'] = $quotOrderForm['access7Name']->getData();
                $this->gvars['access7Qte'] = $access7Qte;

                $mpdfService = $this->get('tfox.mpdfport');
                $html = $this->renderView('AllucoFrontBundle:Quotation:F50_Accord_L.pdf.twig', $this->gvars);
                $response = $mpdfService->generatePdfResponse($html);

                $response->headers->set('Content-Type', 'application/pdf');
                $response->headers->set('Cache-Control', '');
                //$response->headers->set('Content-Length', $doc->getSize());
                $response->headers->set('Last-Modified', gmdate('D, d M Y H:i:s', \time()));
                $contentDisposition = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'F50_Accord_L.pdf');
                $response->headers->set('Content-Disposition', $contentDisposition);


                return $response;
            } else {
                $this->gvars['height'] = \floatval(\floatval($height)/100);
                $this->gvars['width'] = \floatval(\floatval($width)/100);
                $this->flashMsgSession(
                    'error',
                    'Valeurs invalides'
                );
            }
        }

        $this->gvars['showform'] = $showform;

        $this->gvars['F50ALForm'] = $quotForm->createView();

        $this->gvars['F50ALOrderForm'] = $quotOrderForm->createView();


        return $this->renderResponse('AllucoFrontBundle:Quotation:F50_Accord_L.html.twig', $this->gvars);
    }

    public function downloadAction($id) {

        $em = $this->getEntityManager();
        $quotation = $em->getRepository('AllucoDataBundle:Quotation')->find($id);
        if (null == $quotation) {
            return $this->redirect($this->generateUrl('_security_profile'));
        }
        $user = $this->getSecurityContext()->getToken()->getUser();
        if ($user->getId() != $quotation->getUser()->getId()) {
            return $this->redirect($this->generateUrl('_security_profile'));
        }
        if ($quotation->getType() == Quotation::TYPE_F50AL) {
            $json = \json_decode($quotation->getValues(), true);

            $height = $json['height'];
            $widthLR = $json['widthLR'];
            $widthC = $json['widthC'];
            $prof = $json['prof'];
            $profil3Name = $json['profil3Name'];
            $access1Name = $json['access1Name'];
            $access4Name = $json['access4Name'];
            $access6Name = $json['access6Name'];
            $access7Name = $json['access7Name'];

            $width = $widthC + $widthLR;

            $nb = \floatval(\floatval($width)/600);
            $m1 = \round(\floatval(\floatval($widthC)/100))+1;
            $m2 = \round(\floatval(\floatval($widthLR)/100))+1;
            $co=($m1+$m2)*($height-10);
            $nbr= \intval($m1+$m2);
            $profil1Name = 'Quotation.f50AL.profil.1';
            $profil1Qte = \intval(\ceil($nb));
            $profil1Dim = $width;
            $profil1Nb = \intval(\ceil($nb));
            $profil2Name = 'Quotation.f50AL.profil.2';
            $profil2Qte = \intval(\ceil($nbr));
            $profil2Dim = \floatval($co/100);
            $profil2Nb = \intval(\ceil($co/600));
            $profil3Qte = \intval($prof);
            $profil3Dim = \floatval(\intval($prof*$width)/100);
            $profil3Nb = \intval(\ceil((\intval($prof*$width))/600));
            $access1Qte = $nbr;
            $access2Name = 'Quotation.f50AL.access.2';
            $access2Qte = $nbr;
            $access3Name = 'Quotation.f50AL.access.2';
            $access3Qte = \intval($prof*$nbr);
            $access4Qte = \intval($prof);
            $access5Name = 'Quotation.f50AL.access.2';
            $access5Qte = 1;
            $access6Qte = \intval($prof*2);
            $access7Qte = 2;


            $this->gvars['user'] = $user;
            $this->gvars['quotation'] = $quotation;
            $this->gvars['height'] = \floatval(\floatval($height)/100);
            $this->gvars['width'] = \floatval(\floatval($width)/100);
            $this->gvars['prof'] = $prof;
            $this->gvars['profil1Name'] = $profil1Name;
            $this->gvars['profil1Qte'] = $profil1Qte;
            $this->gvars['profil1Dim'] = $profil1Dim;
            $this->gvars['profil1Nb'] = $profil1Nb;
            $this->gvars['profil2Name'] = $profil2Name;
            $this->gvars['profil2Qte'] = $profil2Qte;
            $this->gvars['profil2Dim'] = $profil2Dim;
            $this->gvars['profil2Nb'] = $profil2Nb;
            $this->gvars['profil3Name'] = $profil3Name;
            $this->gvars['profil3Qte'] = $profil3Qte;
            $this->gvars['profil3Dim'] = $profil3Dim;
            $this->gvars['profil3Nb'] = $profil3Nb;
            $this->gvars['access1Name'] = $access1Name;
            $this->gvars['access1Qte'] = $access1Qte;
            $this->gvars['access2Name'] = $access2Name;
            $this->gvars['access2Qte'] = $access2Qte;
            $this->gvars['access3Name'] = $access3Name;
            $this->gvars['access3Qte'] = $access3Qte;
            $this->gvars['access4Name'] = $access4Name;
            $this->gvars['access4Qte'] = $access4Qte;
            $this->gvars['access5Name'] = $access5Name;
            $this->gvars['access5Qte'] = $access5Qte;
            $this->gvars['access6Name'] = $access6Name;
            $this->gvars['access6Qte'] = $access6Qte;
            $this->gvars['access7Name'] = $access7Name;
            $this->gvars['access7Qte'] = $access7Qte;

            $mpdfService = $this->get('tfox.mpdfport');
            $html = $this->renderView('AllucoFrontBundle:Quotation:F50_Accord_L.pdf.twig', $this->gvars);
            $response = $mpdfService->generatePdfResponse($html);

            $response->headers->set('Content-Type', 'application/pdf');
            $response->headers->set('Cache-Control', '');
            //$response->headers->set('Content-Length', $doc->getSize());
            $response->headers->set('Last-Modified', gmdate('D, d M Y H:i:s', \time()));
            $filename = 'F50_Accord_L-'.$quotation->getId().'.pdf';
            $contentDisposition = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $filename);
            $response->headers->set('Content-Disposition', $contentDisposition);


            return $response;
        }

        return $this->redirect($this->generateUrl('_security_profile'));
    }

    public function f50ALAction()
    {

        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_front_quotation');
        }

        $em = $this->getEntityManager();
        $root = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/'));
        $this->gvars['root'] = $root;
        $rootquot = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/quotations'));
        $this->gvars['rootquot'] = $rootquot;
        $staticpage = $em->getRepository('AllucoDataBundle:Staticpage')->findOneBy(array('pageUrl' => '/quotation/F50_Accord_L'));
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

        $quotForm = $this->createForm(new F50ALTForm());

        $quotOrderForm = $this->createForm(new F50ALOrderTForm());

        $showform1 = true;
        $showform2 = false;

        $height = 0;
        $width = 0;
        $widthLR = 0;
        $widthC = 0;
        $prof = 0;

        $request = $this->getRequest();
        $reqData = $request->request->all();
        if (isset($reqData['F50ALForm'])) {
            $quotForm->handleRequest($request);
            if ($quotForm->isValid()) {
                $showform1 = false;
                $showform2 = true;

                $height = $quotForm['height']->getData();
                $widthLR = $quotForm['widthLR']->getData();
                $widthC = $quotForm['widthC']->getData();
                $prof = $quotForm['prof']->getData();
                $width = $widthC + $widthLR;

                $quotOrderForm = $this->createForm(new F50ALOrderTForm($height, $widthLR, $widthC, $prof));

                $nb = \floatval(\floatval($width)/600);
                //$this->gvars['prof'] = \floatval(\floatval($prof)/100);

                $m1 = \round(\floatval(\floatval($widthC)/100))+1;
                $m2 = \round(\floatval(\floatval($widthLR)/100))+1;

                $co=($m1+$m2)*($height-10);
                $nbr= \intval($m1+$m2);



                //Hauteur du Gardes Corps: "+$height+"mètre
                //Largeur du Gardes Corps: "+ $width+"mètre");

                //Profilé
                //Réference / Nom de produit // Quantité // Dimenssion // Nombre de barre (6 Mètre) //

                //F50-200 Main Courante (600Cm) // (int)Math.ceil($nb) // $width mètres // (int)Math.ceil($nb) //
                $profil1Name = 'Quotation.f50AL.profil.1';
                $profil1Qte = \intval(\ceil($nb));
                $profil1Dim = $width;
                $profil1Nb = \intval(\ceil($nb));
                //F50-100 Colonne // (int)Math.ceil($nbr) // <%=co/100 %>mètre // (int)Math.ceil(co/600) //
                $profil2Name = 'Quotation.f50AL.profil.2';
                $profil2Qte = \intval(\ceil($nbr));
                $profil2Dim = \floatval($co/100);
                $profil2Nb = \intval(\ceil($co/600));
                //F50-300 Profilé (600Cm) | F50-301 Profilé (600Cm) // (int)prof // ((int)prof*l)/100%>mètre< // (int)Math.ceil(((int)prof*l)/600) //
                $profil3Qte = \intval($prof);
                $profil3Dim = \floatval(\intval($prof*$width)/100);
                $profil3Nb = \intval(\ceil((\intval($prof*$width))/600));

                // Accessoires
                //Réference / Nom de produit // Quantité //
                //4112 pied de support de poteau F50-100 | 4121 pied de support de poteau F50-100 // nbr //
                $access1Qte = $nbr;
                //4314 support main courante // nbr //
                $access2Name = 'Quotation.f50AL.access.2';
                $access2Qte = $nbr;
                //4312  jonction de poteau F50-100+profilé // (int)prof*nbr //
                $access3Name = 'Quotation.f50AL.access.2';
                $access3Qte = \intval($prof*$nbr);
                //4228 90° jonction de profilé | 4229 135° jonction de profilé | 4302  jonction coudée de profilé // (int)prof //
                $access4Qte = \intval($prof);
                //4329 jonction réglable de main courante // 1 //
                $access5Name = 'Quotation.f50AL.access.2';
                $access5Qte = 1;
                //4438 Bouchon de profilé F50-300 | 4435 Bouchon de profilé F50-301 // (int)prof*2 //
                $access6Qte = \intval($prof*2);
                //4509Z Couvre joint de main courante avec bouchon | 4434 Bouchon de main courante // 2 //
                $access7Qte = 2;



                $this->gvars['height'] = \floatval(\floatval($height)/100);
                $this->gvars['width'] = \floatval(\floatval($width)/100);
                $this->gvars['profil1Name'] = $profil1Name;
                $this->gvars['profil1Qte'] = $profil1Qte;
                $this->gvars['profil1Dim'] = $profil1Dim;
                $this->gvars['profil1Nb'] = $profil1Nb;
                $this->gvars['profil2Name'] = $profil2Name;
                $this->gvars['profil2Qte'] = $profil2Qte;
                $this->gvars['profil2Dim'] = $profil2Dim;
                $this->gvars['profil2Nb'] = $profil2Nb;
                $this->gvars['profil3Qte'] = $profil3Qte;
                $this->gvars['profil3Dim'] = $profil3Dim;
                $this->gvars['profil3Nb'] = $profil3Nb;
                $this->gvars['access1Qte'] = $access1Qte;
                $this->gvars['access2Name'] = $access2Name;
                $this->gvars['access2Qte'] = $access2Qte;
                $this->gvars['access3Name'] = $access3Name;
                $this->gvars['access3Qte'] = $access3Qte;
                $this->gvars['access4Qte'] = $access4Qte;
                $this->gvars['access5Name'] = $access5Name;
                $this->gvars['access5Qte'] = $access5Qte;
                $this->gvars['access6Qte'] = $access6Qte;
                $this->gvars['access7Qte'] = $access7Qte;

                $this->flashMsgSession(
                    'success',
                    $this->translate('Quotation.form1.ok')
                );
            } else {
                $this->flashMsgSession(
                    'error',
                    $this->translate('Quotation.form1.error')
                );
            }
        } elseif (isset($reqData['F50ALOrderForm'])) {
            $quotOrderForm->handleRequest($request);
            if ($quotOrderForm->isValid()) {
                $user = $this->getSecurityContext()->getToken()->getUser();
                $this->gvars['user'] = $user;


                $height = $quotOrderForm['height']->getData();
                $widthLR = $quotOrderForm['widthLR']->getData();
                $widthC = $quotOrderForm['widthC']->getData();
                $prof = $quotOrderForm['prof']->getData();
                $profil3Name = $quotOrderForm['profil3Name']->getData();
                $access1Name = $quotOrderForm['access1Name']->getData();
                $access4Name = $quotOrderForm['access4Name']->getData();
                $access6Name = $quotOrderForm['access6Name']->getData();
                $access7Name = $quotOrderForm['access7Name']->getData();

                $json = array();
                $json['height'] = $height;
                $json['widthC'] = $widthC;
                $json['widthLR'] = $widthLR;
                $json['prof'] = $prof;
                $json['profil3Name'] = $profil3Name;
                $json['access1Name'] = $access1Name;
                $json['access4Name'] = $access4Name;
                $json['access6Name'] = $access6Name;
                $json['access7Name'] = $access7Name;
                $quotation = new Quotation();
                $quotation->setUser($user);
                $quotation->setValues(\json_encode($json));
                $quotation->setType(Quotation::TYPE_F50AL);
                $em->persist($quotation);
                $em->flush();

                $width = $widthC + $widthLR;

                $nb = \floatval(\floatval($width)/600);
                $m1 = \round(\floatval(\floatval($widthC)/100))+1;
                $m2 = \round(\floatval(\floatval($widthLR)/100))+1;
                $co=($m1+$m2)*($height-10);
                $nbr= \intval($m1+$m2);
                $profil1Name = 'Quotation.f50AL.profil.1';
                $profil1Qte = \intval(\ceil($nb));
                $profil1Dim = $width;
                $profil1Nb = \intval(\ceil($nb));
                $profil2Name = 'Quotation.f50AL.profil.2';
                $profil2Qte = \intval(\ceil($nbr));
                $profil2Dim = \floatval($co/100);
                $profil2Nb = \intval(\ceil($co/600));
                $profil3Qte = \intval($prof);
                $profil3Dim = \floatval(\intval($prof*$width)/100);
                $profil3Nb = \intval(\ceil((\intval($prof*$width))/600));
                $access1Qte = $nbr;
                $access2Name = 'Quotation.f50AL.access.2';
                $access2Qte = $nbr;
                $access3Name = 'Quotation.f50AL.access.2';
                $access3Qte = \intval($prof*$nbr);
                $access4Qte = \intval($prof);
                $access5Name = 'Quotation.f50AL.access.2';
                $access5Qte = 1;
                $access6Qte = \intval($prof*2);
                $access7Qte = 2;

                $mvars = array();
                $mvars['user'] = $user;
                $mvars['quotation'] = $quotation;
                $mvars['height'] = \floatval(\floatval($height)/100);
                $mvars['width'] = \floatval(\floatval($width)/100);
                $mvars['prof'] = $prof;
                $mvars['profil1Name'] = $profil1Name;
                $mvars['profil1Qte'] = $profil1Qte;
                $mvars['profil1Dim'] = $profil1Dim;
                $mvars['profil1Nb'] = $profil1Nb;
                $mvars['profil2Name'] = $profil2Name;
                $mvars['profil2Qte'] = $profil2Qte;
                $mvars['profil2Dim'] = $profil2Dim;
                $mvars['profil2Nb'] = $profil2Nb;
                $mvars['profil3Name'] = $profil3Name;
                $mvars['profil3Qte'] = $profil3Qte;
                $mvars['profil3Dim'] = $profil3Dim;
                $mvars['profil3Nb'] = $profil3Nb;
                $mvars['access1Name'] = $access1Name;
                $mvars['access1Qte'] = $access1Qte;
                $mvars['access2Name'] = $access2Name;
                $mvars['access2Qte'] = $access2Qte;
                $mvars['access3Name'] = $access3Name;
                $mvars['access3Qte'] = $access3Qte;
                $mvars['access4Name'] = $access4Name;
                $mvars['access4Qte'] = $access4Qte;
                $mvars['access5Name'] = $access5Name;
                $mvars['access5Qte'] = $access5Qte;
                $mvars['access6Name'] = $access6Name;
                $mvars['access6Qte'] = $access6Qte;
                $mvars['access7Name'] = $access7Name;
                $mvars['access7Qte'] = $access7Qte;

                $mailtos = $this->getParameter('mailtos');

                $from = $this->getParameter('mail_from');
                $fromName = $this->getParameter('mail_from_name');
                $name = $user->getFullName();
                $email = $user->getEmail();
                $subject = $this->translate('breadcrumb.quotation.f50AL').' '.$quotation->getId();
                $body = $this->renderView('AllucoFrontBundle:Quotation:F50_Accord_L.mail.twig', $mvars);

                foreach ($mailtos as $mailto) {
                    $message = \Swift_Message::newInstance()

                    ->setFrom($from, $fromName)
                    ->addTo($mailto['email'], $mailto['name'])
                    ->addReplyTo($email, $name)
                    ->setSubject($subject)
                    ->setBody(
                        $body,
                        'text/html'
                    );

                    $this->sendmail($message);
                }

                $this->flashMsgSession(
                    'success',
                    $this->translate('Quotation.form2.ok')
                );

                $this->getSession()->set('quotation', $quotation->getId());
                return $this->redirect($this->generateUrl('_security_profile'));



            } else {
                $showform1 = false;
                $showform2 = true;

                $height = $quotOrderForm['height']->getData();
                $widthLR = $quotOrderForm['widthLR']->getData();
                $widthC = $quotOrderForm['widthC']->getData();
                $prof = $quotOrderForm['prof']->getData();
                $width = $widthC + $widthLR;

                $nb = \floatval(\floatval($width)/600);
                //$this->gvars['prof'] = \floatval(\floatval($prof)/100);

                $m1 = \round(\floatval(\floatval($widthC)/100))+1;
                $m2 = \round(\floatval(\floatval($widthLR)/100))+1;

                $co=($m1+$m2)*($height-10);
                $nbr= \intval($m1+$m2);



                //Hauteur du Gardes Corps: "+$height+"mètre
                //Largeur du Gardes Corps: "+ $width+"mètre");

                //Profilé
                //Réference / Nom de produit // Quantité // Dimenssion // Nombre de barre (6 Mètre) //

                //F50-200 Main Courante (600Cm) // (int)Math.ceil($nb) // $width mètres // (int)Math.ceil($nb) //
                $profil1Name = 'Quotation.f50AL.profil.1';
                $profil1Qte = \intval(\ceil($nb));
                $profil1Dim = $width;
                $profil1Nb = \intval(\ceil($nb));
                //F50-100 Colonne // (int)Math.ceil($nbr) // <%=co/100 %>mètre // (int)Math.ceil(co/600) //
                $profil2Name = 'Quotation.f50AL.profil.2';
                $profil2Qte = \intval(\ceil($nbr));
                $profil2Dim = \floatval($co/100);
                $profil2Nb = \intval(\ceil($co/600));
                //F50-300 Profilé (600Cm) | F50-301 Profilé (600Cm) // (int)prof // ((int)prof*l)/100%>mètre< // (int)Math.ceil(((int)prof*l)/600) //
                $profil3Qte = \intval($prof);
                $profil3Dim = \floatval(\intval($prof*$width)/100);
                $profil3Nb = \intval(\ceil((\intval($prof*$width))/600));

                // Accessoires
                //Réference / Nom de produit // Quantité //
                //4112 pied de support de poteau F50-100 | 4121 pied de support de poteau F50-100 // nbr //
                $access1Qte = $nbr;
                //4314 support main courante // nbr //
                $access2Name = 'Quotation.f50AL.access.2';
                $access2Qte = $nbr;
                //4312  jonction de poteau F50-100+profilé // (int)prof*nbr //
                $access3Name = 'Quotation.f50AL.access.2';
                $access3Qte = \intval($prof*$nbr);
                //4228 90° jonction de profilé | 4229 135° jonction de profilé | 4302  jonction coudée de profilé // (int)prof //
                $access4Qte = \intval($prof);
                //4329 jonction réglable de main courante // 1 //
                $access5Name = 'Quotation.f50AL.access.2';
                $access5Qte = 1;
                //4438 Bouchon de profilé F50-300 | 4435 Bouchon de profilé F50-301 // (int)prof*2 //
                $access6Qte = \intval($prof*2);
                //4509Z Couvre joint de main courante avec bouchon | 4434 Bouchon de main courante // 2 //
                $access7Qte = 2;



                $this->gvars['height'] = \floatval(\floatval($height)/100);
                $this->gvars['width'] = \floatval(\floatval($width)/100);
                $this->gvars['profil1Name'] = $profil1Name;
                $this->gvars['profil1Qte'] = $profil1Qte;
                $this->gvars['profil1Dim'] = $profil1Dim;
                $this->gvars['profil1Nb'] = $profil1Nb;
                $this->gvars['profil2Name'] = $profil2Name;
                $this->gvars['profil2Qte'] = $profil2Qte;
                $this->gvars['profil2Dim'] = $profil2Dim;
                $this->gvars['profil2Nb'] = $profil2Nb;
                $this->gvars['profil3Qte'] = $profil3Qte;
                $this->gvars['profil3Dim'] = $profil3Dim;
                $this->gvars['profil3Nb'] = $profil3Nb;
                $this->gvars['access1Qte'] = $access1Qte;
                $this->gvars['access2Name'] = $access2Name;
                $this->gvars['access2Qte'] = $access2Qte;
                $this->gvars['access3Name'] = $access3Name;
                $this->gvars['access3Qte'] = $access3Qte;
                $this->gvars['access4Qte'] = $access4Qte;
                $this->gvars['access5Name'] = $access5Name;
                $this->gvars['access5Qte'] = $access5Qte;
                $this->gvars['access6Qte'] = $access6Qte;
                $this->gvars['access7Qte'] = $access7Qte;
                $this->flashMsgSession(
                    'error',
                    $this->translate('Quotation.form2.error')
                );
            }
        }

        $this->gvars['showform1'] = $showform1;
        $this->gvars['showform2'] = $showform2;

        $this->gvars['F50ALForm'] = $quotForm->createView();

        $this->gvars['F50ALOrderForm'] = $quotOrderForm->createView();


        return $this->renderResponse('AllucoFrontBundle:Quotation:F50_Accord_L.html.twig', $this->gvars);
    }

}