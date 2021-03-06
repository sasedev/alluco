<?php

namespace Sasedev\Commons\SharedBundle\Controller;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Bundle\FrameworkBundle\Templating\DelegatingEngine;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\DependencyInjection\ContainerAwareHttpKernel;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Validator\Validator;

/**
 * The Default BaseController
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class BaseController extends ContainerAware
{

    /**
     * Check if a service exist
     *
     * @param string $id
     *
     * @return boolean
     */
    public function has($id)
    {

        return $this->container->has($id);

    }

    /**
     * Get a service
     *
     * @param string $id
     *
     * @throws \LogicException
     * @return object
     */
    public function get($id)
    {

        if (!$this->has($id)) {
            throw new \LogicException('The service ' . $id . ' is not installed in your application.');
        }

        return $this->container->get($id);

    }

    /**
     * Gets a parameter.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function getParameter($name)
    {

        return $this->container->getParameter($name);

    }

    /**
     * Get Monolog Logger
     *
     * @return \Symfony\Bridge\Monolog\Logger
     */
    public function getLogger()
    {

        return $this->get('logger');

    }

    /**
     * Get Swiftmail Mailer
     *
     * @return Swift_Mailer
     */
    public function getMailer()
    {

        return $this->get('mailer');

    }

    /**
     * Get symfony router
     *
     * @return \Symfony\Bundle\FrameworkBundle\Routing\Router
     */
    public function getRouter()
    {

        return $this->get('router');

    }

    /**
     * Get Symfony HttpKernel
     *
     * @return \Symfony\Component\HttpKernel\DependencyInjection\ContainerAwareHttpKernel
     */
    public function getHttpKernel()
    {

        return $this->get('http_kernel');

    }

    /**
     * Get Request
     *
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function getRequest()
    {

        return $this->get('request');

    }

    /**
     * Get Session
     *
     * @return \Symfony\Component\HttpFoundation\Session\Session
     */
    public function getSession()
    {

        return $this->get('session');

    }

    /**
     * Get doctrine service
     *
     * @return \Doctrine\Bundle\DoctrineBundle\Registry
     */
    public function getDoctrine()
    {

        return $this->get('doctrine');

    }

    /**
     * Get the translator service
     *
     * @return \Symfony\Component\Translation\Translator
     */
    public function getTranslator()
    {

        return $this->get('translator');

    }

    /**
     * Get security context
     *
     * @return SecurityContext
     */
    public function getSecurityContext()
    {

        return $this->get('security.context');

    }

    /**
     * Get Form Factory
     *
     * @return \Symfony\Component\Form\FormFactory
     */
    public function getFormFactory()
    {

        return $this->get('form.factory');

    }

    /**
     * Get validator service
     *
     * @return \Symfony\Component\Validator\Validator
     */
    public function getValidator()
    {

        return $this->get('validator');

    }

    /**
     * Get templating service
     *
     * @return \Symfony\Bundle\FrameworkBundle\Templating\DelegatingEngine
     */
    public function getTemplating()
    {

        return $this->get('templating');

    }

    /**
     * Generate url
     *
     * @param string $route
     * @param mixed $parameters
     * @param boolean $absolute
     *
     * @return string The generated url
     */
    public function generateUrl($route, $parameters = array(), $absolute = false)
    {

        return $this->getRouter()->generate($route, $parameters, $absolute);

    }

    /**
     * Get referer
     *
     * @return string
     */
    public function getReferer()
    {

        return $this->getRequest()->headers->get('referer');

    }

    /**
     * Forward to another controller
     *
     * @param string $controller
     * @param array $path
     * @param array $query
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function forward($controller, $path = array(), $query = array())
    {

        $path['_controller'] = $controller;
        $subRequest = $this->getRequest()->duplicate($query, null, $path);

        return $this->getHttpKernel()->handle($subRequest, HttpKernelInterface::SUB_REQUEST);

    }

    /**
     * Return Redirect Response
     *
     * @param string $url
     * @param integer $status
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirect($url, $status = 302)
    {

        return new RedirectResponse($url, $status);

    }

    /**
     * Add a flash message
     *
     * @param string $type
     * @param string $msg
     */
    public function flashMsgSession($type, $msg)
    {

        $this->getSession()->getFlashBag()->set($type, $msg);

    }

    /**
     * Get Doctrine Entity Manager
     *
     * @return \Doctrine\Common\Persistence\ObjectManager
     */
    public function getEntityManager()
    {
        $entityManager = $this->getDoctrine()->getManager();
        if (!$entityManager->isOpen()) {
            $entityManager = $entityManager->create(
                $entityManager->getConnection(), $entityManager->getConfiguration());
        }

        return $entityManager;

    }

    /**
     * Translates the given message.
     *
     * @param string $id
     * @param array $parameters
     * @param string $domain
     * @param string $locale
     *
     * @return string
     */
    public function translate($id, $parameters = array(), $domain = 'messages', $locale = null)
    {

        return $this->getTranslator()->trans($id, $parameters, $domain, $locale);

    }

    /**
     * Checks if the attributes are granted against the current token.Checks if
     * the attributes are
     * granted against the current authentication token and optionally supplied
     * object.
     *
     * @param mixed $rolename
     *
     * @return boolean
     */
    public function hasRole($rolename)
    {

        return $this->getSecurityContext()->isGranted($rolename);

    }

    /**
     * Form Factory Builder
     *
     * @param string|\Symfony\Component\Form\FormBuilderInterface $formName
     * @param string $data
     * @param array $options
     *
     * @return \Symfony\Component\Form\FormBuilderInterface
     */
    public function createFormBuilder($formName, $data = null, $options = array())
    {

        return $this->getFormFactory()->createBuilder($formName, $data, $options);

    }

    /**
     * Create a Form
     *
     * @param string|\Symfony\Component\Form\FormInterface $type
     * @param string $data
     * @param array $options
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createForm($type, $data = null, $options = array())
    {

        return $this->getFormFactory()->create($type, $data, $options);

    }

    /**
     * Render a view
     *
     * @param mixed $view
     * @param array $parameters
     *
     * @return string
     */
    public function renderView($view, $parameters = array())
    {

        return $this->getTemplating()->render($view, $parameters);

    }

    /**
     * Render a response
     *
     * @param string $view
     * @param array $parameters
     * @param \Symfony\Component\HttpFoundation\Response $response
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function renderResponse($view, $parameters = array(), $response = null)
    {

        return $this->getTemplating()->renderResponse($view, $parameters, $response);

    }

    /**
     * Send a message by mail
     * The return value is the number of recipients who were accepted for
     * delivery.
     *
     * @param Swift_Mime_Message $message
     *
     * @return integer
     */
    public function sendmail($message)
    {

        return $this->getMailer()->send($message);

    }

    /**
     * Check if a string ends with a suffix
     *
     * @param string $string
     * @param string $suffix
     *
     * @return boolean
     */
    public function endswith($string, $suffix)
    {

        $strlen = strlen($string);
        $testlen = strlen($suffix);
        if ($testlen > $strlen) {
            return false;
        }

        return substr_compare($string, $suffix, -$testlen) === 0;

    }

    /**
     * Normalize a string
     *
     * @param string $string
     *
     * @return string
     */
    public function normalize($string)
    {

        $table = array(
            'Š' => 'S',
            'š' => 's',
            'Ð' => 'Dj',
            'Ž' => 'Z',
            'ž' => 'z',
            'C' => 'C',
            'c' => 'c',
            'C' => 'C',
            'c' => 'c',
            'À' => 'A',
            'Á' => 'A',
            'Â' => 'A',
            'Ã' => 'A',
            'Ä' => 'A',
            'Å' => 'A',
            'Æ' => 'A',
            'Ç' => 'C',
            'È' => 'E',
            'É' => 'E',
            'Ê' => 'E',
            'Ë' => 'E',
            'Ì' => 'I',
            'Í' => 'I',
            'Î' => 'I',
            'Ï' => 'I',
            'Ñ' => 'N',
            'Ò' => 'O',
            'Ó' => 'O',
            'Ô' => 'O',
            'Õ' => 'O',
            'Ö' => 'O',
            'Ø' => 'O',
            'Ù' => 'U',
            'Ú' => 'U',
            'Û' => 'U',
            'Ü' => 'U',
            'Ý' => 'Y',
            'Þ' => 'B',
            'ß' => 'Ss',
            'à' => 'a',
            'á' => 'a',
            'â' => 'a',
            'ã' => 'a',
            'ä' => 'a',
            'å' => 'a',
            'æ' => 'a',
            'ç' => 'c',
            'è' => 'e',
            'é' => 'e',
            'ê' => 'e',
            'ë' => 'e',
            'ì' => 'i',
            'í' => 'i',
            'î' => 'i',
            'ï' => 'i',
            'ð' => 'o',
            'ñ' => 'n',
            'ò' => 'o',
            'ó' => 'o',
            'ô' => 'o',
            'õ' => 'o',
            'ö' => 'o',
            'ø' => 'o',
            'ù' => 'u',
            'ú' => 'u',
            'û' => 'u',
            'ý' => 'y',
            'ý' => 'y',
            'þ' => 'b',
            'ÿ' => 'y',
            'R' => 'R',
            'r' => 'r'
        );

        return strtr($string, $table);
    }
}
