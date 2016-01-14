<?php

namespace Sasedev\Commons\SharedBundle\Listener;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Security\Core\SecurityContext;
use Sasedev\Commons\SharedBundle\Model\BaseUser;

/**
 * Activity Listener
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class Activity
{

    /**
     *
     * @var \Symfony\Component\Security\Core\SecurityContext
     */
    private $securityContext;

    /**
     *
     * @var EntityManager
     */
    private $em;

    /**
     * Constructor
     *
     * @param SecurityContext $securityContext
     * @param Doctrine $doctrine
     */
    public function __construct(SecurityContext $securityContext, Doctrine $doctrine)
    {

        $this->securityContext = $securityContext;
        $this->em = $doctrine->getManager();

    }

    /**
     * Update the user "lastActivity" on each request
     *
     * @param FilterControllerEvent $event
     */
    public function onCoreController(FilterControllerEvent $event)
    {
        // Here we are checking that the current request is a "MASTER_REQUEST",
        // and ignore any
        // subrequest in the process (for example when
        // doing a render() in a twig template)
        if ($event->getRequestType() !== HttpKernel::MASTER_REQUEST) {
            return;
        }

        // We are checking a token authentification is available before using
        // the User
        if ($this->securityContext->getToken()) {
            $user = $this->securityContext->getToken()->getUser();

            // We are using a delay during wich the user will be considered as
            // still active, in order to
            // avoid too much UPDATE in the
            // database
            // $delay = new \DateTime ();
            // $delay->setTimestamp (strtotime ('2 minutes ago'));

            // We are checking the Admin class in order to be certain we can
            // call "getLastActivity".
            // && $user->getLastActivity() < $delay) {
            if ($user instanceof BaseUser) {
                $user->isActiveNow();
                $this->em->persist($user);
                $this->em->flush();
            }
        }

    }
}
