<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            new JMS\AopBundle\JMSAopBundle(),
            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new JMS\SerializerBundle\JMSSerializerBundle(),
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new BCC\ExtraToolsBundle\BCCExtraToolsBundle(),
            new Liip\ImagineBundle\LiipImagineBundle(),
            new Liuggio\ExcelBundle\LiuggioExcelBundle(),
            new TFox\MpdfPortBundle\TFoxMpdfPortBundle(),
            new Lexik\Bundle\TranslationBundle\LexikTranslationBundle(),
            new Lunetics\LocaleBundle\LuneticsLocaleBundle(),
            new Cocur\Slugify\Bridge\Symfony\CocurSlugifyBundle(),
            new Gregwar\CaptchaBundle\GregwarCaptchaBundle(),

            new Sasedev\Doctrine\PostgresqlBundle\SasedevDoctrinePostgresqlBundle(),
            new Sasedev\Commons\SharedBundle\SasedevCommonsSharedBundle(),
            new Sasedev\Commons\BootstrapBundle\SasedevCommonsBootstrapBundle(),
            new Sasedev\Commons\TwigBundle\SasedevCommonsTwigBundle(),
            new Sasedev\Form\PlainBundle\SasedevFormPlainBundle(),
            new Sasedev\Form\EntityidBundle\SasedevFormEntityidBundle(),

            new Alluco\DataBundle\AllucoDataBundle(),
            new Alluco\ResBundle\AllucoResBundle(),
            new Alluco\SecurityBundle\AllucoSecurityBundle(),
            new Alluco\FrontBundle\AllucoFrontBundle(),
            new Alluco\AdminBundle\AllucoAdminBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
