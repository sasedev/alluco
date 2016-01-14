<?php
namespace Alluco\AdminBundle\Controller;

use Alluco\DataBundle\Entity\Job;
use Alluco\DataBundle\Entity\JobTrans;
use Alluco\AdminBundle\Form\Job\NewTForm as JobNewTForm;
use Alluco\AdminBundle\Form\Job\UpdateNameTForm as JobUpdateNameTForm;
use Alluco\AdminBundle\Form\Job\UpdateRankTForm as JobUpdateRankTForm;
use Alluco\AdminBundle\Form\Job\UpdateStatusTForm as JobUpdateStatusTForm;
use Alluco\AdminBundle\Form\JobTrans\UpdateNameTForm as JobTransUpdateNameTForm;
use Sasedev\Commons\SharedBundle\Controller\BaseController;

/**
 * @author sasedev <sasedev.bifidis@gmail.com>
 *
 */
class JobController extends BaseController
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

        $this->gvars['menu_active'] = 'job';

    }

    public function listAction()
    {
        $em = $this->getEntityManager();
        $jobs = $em->getRepository('AllucoDataBundle:Job')->getAll();
        $this->gvars['jobs'] = $jobs;

        $this->gvars['smenu_active'] = 'list';
        $this->gvars['pagetitle'] = $this->translate('Pagetitle.job.list');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.job.list.txt');
        return $this->renderResponse('AllucoAdminBundle:Job:list.html.twig', $this->gvars);
    }

    public function addGetAction()
    {
        $job = new Job();
        $jobNewForm = $this->createForm(new JobNewTForm(), $job);
        $this->gvars['JobNewForm'] = $jobNewForm->createView();

        $this->gvars['pagetitle'] = $this->translate('Pagetitle.job.add');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.job.add.txt');
        $this->gvars['smenu_active'] = 'add';

        return $this->renderResponse('AllucoAdminBundle:Job:add.html.twig', $this->gvars);
    }

    public function addPostAction()
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            return $this->redirect($this->generateUrl('_admin_job_addGet'));
        }

        $job = new Job();
        $jobNewForm = $this->createForm(new JobNewTForm(), $job);
        $this->gvars['JobNewForm'] = $jobNewForm->createView();

        $request = $this->getRequest();
        $reqData = $request->request->all();

        if (isset($reqData['JobNewForm'])) {
            $jobNewForm->handleRequest($request);
            if ($jobNewForm->isValid()) {
                $em = $this->getEntityManager();
                $em->persist($job);
                $em->flush();

                $langs = $em->getRepository('AllucoDataBundle:Lang')->getAll();
                foreach ($langs as $lang) {
                    $jobTrans = new JobTrans();
                    $jobTrans->setJob($job);
                    $jobTrans->setLang($lang);
                    $jobTrans->setName($job->getName());
                    try {
                        $em->persist($jobTrans);
                        $em->flush();
                    } catch (\Exception $e) {
                        // ne rien faire
                    }
                }

                $this->flashMsgSession(
                    'success',
                    $this->translate('Job.add.success', array('%job%' => $job->getName()))
                );

                return $this->redirect(
                    $this->generateUrl('_admin_job_editGet', array('id' => $job->getId()))
                );
            } else {
                $this->flashMsgSession(
                    'error',
                    $this->translate('Job.add.failure', array('%job%' => $jobNewForm['nameFr']->getData()))
                );
            }
        }

        $this->gvars['pagetitle'] = $this->translate('Pagetitle.job.add');
        $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.job.add.txt');
        $this->gvars['smenu_active'] = 'add';

        return $this->renderResponse('AllucoAdminBundle:Job:add.html.twig', $this->gvars);
    }

    public function deleteAction($id)
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_admin_job_list');
        }
        $em = $this->getEntityManager();
        try {
            $job = $em->getRepository('AllucoDataBundle:Job')->find($id);

            if (null == $job) {
                $this->flashMsgSession('warning', 'Job.delete.notfound');
            } else {
                $em->remove($job);
                $em->flush();

                $this->flashMsgSession(
                    'success',
                    $this->translate('Job.delete.success', array('%job%' => $job->getName()))
                );
            }
        } catch (\Exception $e) {
            $logger = $this->getLogger();
            $logger->addCritical($e->getLine().' '.$e->getMessage().' '.$e->getTraceAsString());

            $this->flashMsgSession('error', $this->translate('Job.delete.failure'));
        }

        return $this->redirect($urlFrom);

    }

    public function editGetAction($id)
    {
        $urlFrom = $this->getReferer();
        if (null == $urlFrom || trim($urlFrom) == '') {
            $urlFrom = $this->generateUrl('_admin_job_list');
        }

        $em = $this->getEntityManager();
        try {
            $job = $em->getRepository('AllucoDataBundle:Job')->find($id);

            if (null == $job) {
                $this->flashMsgSession('warning', 'Job.edit.notfound');
            } else {
                $jobUpdateNameForm = $this->createForm(new JobUpdateNameTForm(), $job);
                $jobUpdateRankForm = $this->createForm(new JobUpdateRankTForm(), $job);
                $jobUpdateStatusForm = $this->createForm(new JobUpdateStatusTForm(), $job);

                $this->gvars['job'] = $job;
                $this->gvars['JobUpdateNameForm'] = $jobUpdateNameForm->createView();
                $this->gvars['JobUpdateRankForm'] = $jobUpdateRankForm->createView();
                $this->gvars['JobUpdateStatusForm'] = $jobUpdateStatusForm->createView();

                $langs = $em->getRepository('AllucoDataBundle:Lang')->getAll();
                $this->gvars['langs'] = $langs;
                foreach ($langs as $lang) {
                    $jobTrans = $em->getRepository('AllucoDataBundle:JobTrans')->findOneBy(array('lang' => $lang, 'job' => $job));
                    if (null == $jobTrans) {
                        $jobTrans = new JobTrans();
                        $jobTrans->setJob($job);
                        $jobTrans->setLang($lang);
                        $jobTrans->setName($job->getName());
                        try {
                            $em->persist($jobTrans);
                            $em->flush();
                        } catch (\Exception $e) {
                            // ne rien faire
                        }
                    }
                }

                $em->refresh($job);


                foreach ($job->getI18ns() as $jobTrans) {
                    $jobTransUpdateNameForm = $this->createForm(new JobTransUpdateNameTForm($jobTrans->getLang()->getLocale()), $jobTrans);
                    $this->gvars['JobTransUpdateNameForm'][$jobTrans->getLang()->getLocale()] = $jobTransUpdateNameForm->createView();
                }

                $this->gvars['tabActive'] = $this->getSession()->get('tabActive', 1);
                $this->getSession()->remove('tabActive');



                $this->gvars['pagetitle'] = $this->translate('Pagetitle.job.edit', array('%job%' => $job->getName()));
                $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.job.edit.txt', array('%job%' => $job->getName()));

                return $this->renderResponse('AllucoAdminBundle:Job:edit.html.twig', $this->gvars);
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
            return $this->redirect($this->generateUrl('_admin_job_list'));
        }

        $em = $this->getEntityManager();
        try {
            $job = $em->getRepository('AllucoDataBundle:Job')->find($id);

            if (null == $job) {
                $this->flashMsgSession('warning', 'Job.edit.notfound');
            } else {
                $jobUpdateNameForm = $this->createForm(new JobUpdateNameTForm(), $job);
                $jobUpdateRankForm = $this->createForm(new JobUpdateRankTForm(), $job);
                $jobUpdateStatusForm = $this->createForm(new JobUpdateStatusTForm(), $job);

                $langs = $em->getRepository('AllucoDataBundle:Lang')->getAll();
                $this->gvars['langs'] = $langs;
                foreach ($langs as $lang) {
                    $jobTrans = $em->getRepository('AllucoDataBundle:JobTrans')->findOneBy(array('lang' => $lang, 'job' => $job));
                    if (null == $jobTrans) {
                        $jobTrans = new JobTrans();
                        $jobTrans->setJob($job);
                        $jobTrans->setLang($lang);
                        $jobTrans->setName($job->getName());
                        try {
                            $em->persist($jobTrans);
                            $em->flush();
                        } catch (\Exception $e) {
                            // ne rien faire
                        }
                    }
                }

                $em->refresh($job);



                $this->gvars['tabActive'] = $this->getSession()->get('tabActive', 2);
                $this->getSession()->remove('tabActive');

                $request = $this->getRequest();
                $reqData = $request->request->all();

                if (isset($reqData['JobUpdateNameForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $jobUpdateNameForm->handleRequest($request);
                    if ($jobUpdateNameForm->isValid()) {
                        $em->persist($job);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('Job.edit.success', array('%job%' => $job->getName()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($job);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('Job.edit.failure', array('%job%' => $job->getName()))
                        );
                    }
                } elseif (isset($reqData['JobUpdateRankForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $jobUpdateRankForm->handleRequest($request);
                    if ($jobUpdateRankForm->isValid()) {
                        $em->persist($job);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('Job.edit.success', array('%job%' => $job->getName()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($job);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('Job.edit.failure', array('%job%' => $job->getName()))
                        );
                    }
                } elseif (isset($reqData['JobUpdateStatusForm'])) {
                    $this->gvars['tabActive'] = 2;
                    $this->getSession()->set('tabActive', 2);
                    $jobUpdateStatusForm->handleRequest($request);
                    if ($jobUpdateStatusForm->isValid()) {
                        $em->persist($job);
                        $em->flush();
                        $this->flashMsgSession(
                            'success',
                            $this->translate('Job.edit.success', array('%job%' => $job->getName()))
                        );

                        return $this->redirect($urlFrom);
                    } else {
                        $em->refresh($job);

                        $this->flashMsgSession(
                            'error',
                            $this->translate('Job.edit.failure', array('%job%' => $job->getName()))
                        );
                    }
                }

                foreach ($job->getI18ns() as $jobTrans) {
                    $em->refresh($jobTrans);
                    $jobTransUpdateNameForm = $this->createForm(new JobTransUpdateNameTForm($jobTrans->getLang()->getLocale()), $jobTrans);
                    if (isset($reqData['JobTransUpdateNameForm_'.$jobTrans->getLang()->getLocale()])) {
                        $this->gvars['tabActive'] = $jobTrans->getLang()->getLocale();
                        $this->getSession()->set('tabActive', $jobTrans->getLang()->getLocale());
                        $jobTransUpdateNameForm->handleRequest($request);
                        if ($jobTransUpdateNameForm->isValid()) {
                            $em->persist($jobTrans);
                            $em->flush();
                            $this->flashMsgSession(
                                'success',
                                $this->translate('JobTrans.edit.success', array('%job%' => $job->getName()))
                            );

                            return $this->redirect($urlFrom);
                        } else {
                            $em->refresh($job);

                            $this->flashMsgSession(
                                'error',
                                $this->translate('JobTrans.edit.failure', array('%job%' => $job->getName()))
                            );
                        }
                    }
                    $this->gvars['JobTransUpdateNameForm'][$jobTrans->getLang()->getLocale()] = $jobTransUpdateNameForm->createView();
                }

                $this->gvars['job'] = $job;
                $this->gvars['JobUpdateNameForm'] = $jobUpdateNameForm->createView();
                $this->gvars['JobUpdateRankForm'] = $jobUpdateRankForm->createView();
                $this->gvars['JobUpdateStatusForm'] = $jobUpdateStatusForm->createView();

                $this->gvars['pagetitle'] = $this->translate('Pagetitle.job.edit', array('%job%' => $job->getName()));
                $this->gvars['pagetitle_txt'] = $this->translate('Pagetitle.job.edit.txt', array('%job%' => $job->getName()));

                return $this->renderResponse('AllucoAdminBundle:Job:edit.html.twig', $this->gvars);
            }
        } catch (\Exception $e) {
            $logger = $this->getLogger();
            $logger->addCritical($e->getLine().' '.$e->getMessage().' '.$e->getTraceAsString());
        }

        return $this->redirect($urlFrom);

    }
}
