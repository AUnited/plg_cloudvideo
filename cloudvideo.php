<?php
# @ 2014-2016 Vitaliy Zhukov. All rights reserved. GNU/GPL v3 licence

# Assert file included in Joomla!
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

#Cloud video Content Plugin
class plgContentcloudvideo extends JPlugin
{

	function Plugincloudvideo( &$subject, $params )
	{
		parent::__construct( $subject, $params );
	}

	function onContentPrepare ( $context, &$article, &$params, $page = 0)
		{
		global $mainframe;

        $supported = array('youtube, youpl, vk, rutube, vimeo, dailymotion, flickr, vine, soundcloud');

        $func = array
        (
            'youtube' => function ($match){return $this->ytVideo($match[1]);},
            'youpl' => function ($match){return $this->yplVideo($match[1]);},
            'vk' => function ($match){return $this->vkVideo($match[1]);},
            'rutube' => function ($match){return $this->rtVideo($match[1]);},
            'vimeo' => function ($match){return $this->vimeoVideo($match[1]);},
            'dailymotion' => function ($match){return $this->dmVideo($match[1]);},
            'flickr' => function ($match){return $this->flVideo($match[1]);},
            'vine' => function ($match){return $this->vineVideo($match[1]);},
            'soundcloud' => function ($match){return $this->scVideo($match[1]);},
        );


        foreach ($supported as &$htype)
        {
            if ( JString::strpos( $article->text, '{'.$htype.'}' ))
            {
                $article->text = preg_replace_callback('|{'.$htype.'}(.*){\/'.$htype.'}|',$func[$htype], $article->text);
            }
        }
            unset($htype);

		return true;
	}

	function ytVideo($vCode)
	{
	 	$params = $this->params;

		$width = $params->get('width', 432);
		$height = $params->get('height', 243);
        $confidence = $params->get('confidence', 0);
        $fullscreen = $params->get('fullscreen', 1);

        #Logic
        if($confidence) $url='www.youtube-nocookie.com'; else $url='www.youtube.com';
        if($fullscreen) $fscr=' allowfullscreen'; else $fscr='';
	
		return '<iframe width="'.$width.'" height="'.$height.'" src="https://'.$url.'/embed/'.$vCode.'" frameborder="0"'.$fscr.'></iframe>';
	}

	function yplVideo($vCode)
    {
        $params = $this->params;

        $width = $params->get('width', 432);
        $height = $params->get('height', 243);
        $confidence = $params->get('confidence', 0);
        $fullscreen = $params->get('fullscreen', 1);

        #Logic
        if($confidence) $url='www.youtube-nocookie.com'; else $url='www.youtube.com';
        if($fullscreen) $fscr=' allowfullscreen'; else $fscr='';

        return '<iframe width="'.$width.'" height="'.$height.'" src="https://'.$url.'/embed/videoseries?list='.$vCode.'" frameborder="0" '.$fscr.'></iframe>';
    }

    function vkVideo($vCode)
    {
        $params = $this->params;

        $width = $params->get('width', 432);
        $height = $params->get('height', 243);
        $confidence = $params->get('confidence', 0);
        $fullscreen = $params->get('fullscreen', 1);

        #Logic
        if($confidence) $url='www.youtube-nocookie.com'; else $url='www.youtube.com';
        if($fullscreen) $fscr=' allowfullscreen'; else $fscr='';

        return '<iframe width="'.$width.'" height="'.$height.'" src="https://'.$url.'/embed/videoseries?list='.$vCode.'" frameborder="0" '.$fscr.'></iframe>';
    }

    function rtVideo($vCode)
    {
        $params = $this->params;

        $width = $params->get('width', 432);
        $height = $params->get('height', 243);
        $fullscreen = $params->get('fullscreen', 1);

        #Logic
        if($confidence) $url='www.youtube-nocookie.com'; else $url='www.youtube.com';
        if($fullscreen) $fscr=' allowfullscreen'; else $fscr='';

        return '<iframe width="'.$width.'" height="'.$height.'" src="https://rutube.ru/play/embed/'.$vCode.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowfullscreen></iframe>';
    }

    function vimeoVideo($vCode)
    {
        $params = $this->params;

        $width = $params->get('width', 432);
        $height = $params->get('height', 243);
        $confidence = $params->get('confidence', 0);
        $fullscreen = $params->get('fullscreen', 1);

        #Logic
        if($confidence) $url='www.youtube-nocookie.com'; else $url='www.youtube.com';
        if($fullscreen) $fscr=' allowfullscreen'; else $fscr='';

        return '<iframe src="https://player.vimeo.com/video/'.$vCode.'?title=0&byline=0&portrait=0&badge=0" width="'.$width.'" height="'.$height.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
    }

    function dmVideo($vCode)
    {
        $params = $this->params;

        $width = $params->get('width', 432);
        $height = $params->get('height', 243);
        $confidence = $params->get('confidence', 0);
        $fullscreen = $params->get('fullscreen', 1);

        #Logic
        if($confidence) $url='www.youtube-nocookie.com'; else $url='www.youtube.com';
        if($fullscreen) $fscr=' allowfullscreen'; else $fscr='';

        return '<iframe frameborder="0" width="480" height="270" src="//www.dailymotion.com/embed/video/x38nftj?autoPlay=1&start=90" allowfullscreen></iframe><iframe frameborder="0" width="480" height="270" src="//www.dailymotion.com/embed/video/x38nftj?autoPlay=1&start=90" allowfullscreen></iframe>';
    }

    function flVideo($vCode)
    {
        $params = $this->params;

        $width = $params->get('width', 432);
        $height = $params->get('height', 243);
        $confidence = $params->get('confidence', 0);
        $fullscreen = $params->get('fullscreen', 1);

        #Logic
        if($confidence) $url='www.youtube-nocookie.com'; else $url='www.youtube.com';
        if($fullscreen) $fscr=' allowfullscreen'; else $fscr='';

        return '<iframe width="'.$width.'" height="'.$height.'" src="https://'.$url.'/embed/videoseries?list='.$vCode.'" frameborder="0" '.$fscr.'></iframe>';
    }

    function vineVideo($vCode)
    {
        $params = $this->params;

        $width = $params->get('width', 432);
        $height = $params->get('height', 243);
        $confidence = $params->get('confidence', 0);
        $fullscreen = $params->get('fullscreen', 1);

        #Logic
        if($confidence) $url='www.youtube-nocookie.com'; else $url='www.youtube.com';
        if($fullscreen) $fscr=' allowfullscreen'; else $fscr='';

        return '<iframe width="'.$width.'" height="'.$height.'" src="https://'.$url.'/embed/videoseries?list='.$vCode.'" frameborder="0" '.$fscr.'></iframe>';
    }

    function scVideo($vCode)
    {
        $params = $this->params;

        $width = $params->get('width', 432);
        $height = $params->get('height', 243);
        $confidence = $params->get('confidence', 0);
        $fullscreen = $params->get('fullscreen', 1);

        #Logic
        if($confidence) $url='www.youtube-nocookie.com'; else $url='www.youtube.com';
        if($fullscreen) $fscr=' allowfullscreen'; else $fscr='';

        return '<iframe width="'.$width.'" height="'.$height.'" src="https://'.$url.'/embed/videoseries?list='.$vCode.'" frameborder="0" '.$fscr.'></iframe>';
    }
}
