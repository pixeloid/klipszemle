<?php 

namespace Pixeloid\AppBundle\Twig;

class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
           new \Twig_SimpleFilter('yt_id', array($this, 'youtubeIdFilter')),
        );
    }

    public function youtubeIdFilter($url)
    {
    	if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
    	    $video_id = $match[1];
    		
    		return $video_id;
    	}

        return false;
    }

    public function getName()
    {
        return 'app_extension';
    }
}
