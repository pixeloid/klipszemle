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
            // new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            new FOS\UserBundle\FOSUserBundle(),
            new Braincrafted\Bundle\BootstrapBundle\BraincraftedBootstrapBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new Ivory\GoogleMapBundle\IvoryGoogleMapBundle(),
            new Fkr\CssURLRewriteBundle\FkrCssURLRewriteBundle(),
            new Hpatoio\DeployBundle\DeployBundle(),
            new EWZ\Bundle\RecaptchaBundle\EWZRecaptchaBundle(),
            new Craue\FormFlowBundle\CraueFormFlowBundle(),
            new TeamLab\Bundle\FixturesBundle\DoctrineDumpFixturesBundle(),
            new Knp\Bundle\SnappyBundle\KnpSnappyBundle(),
            new Spraed\PDFGeneratorBundle\SpraedPDFGeneratorBundle(),
            new Ensepar\Html2pdfBundle\EnseparHtml2pdfBundle(),
            new Ivory\CKEditorBundle\IvoryCKEditorBundle(),
            new Avalanche\Bundle\ImagineBundle\AvalancheImagineBundle(),
            new Sg\DatatablesBundle\SgDatatablesBundle(),
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),

            new Pixeloid\AppBundle\PixeloidAppBundle(),
            new Pixeloid\UserBundle\PixeloidUserBundle(),
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
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
