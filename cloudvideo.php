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

        $supported = array('youtube, youpl, rutube, vimeo, dailymotion, flickr, vine, soundcloud');

        $func = array
        (
            'youtube' => function ($match){return $this->ytVideo($match[1]);},
            'youpl' => function ($match){return $this->yplVideo($match[1]);},
            //'vk' => function ($match){return $this->vkVideo($match[1]);},
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
        $fullscreen = $params->get('fullscreen', 1);
        #Parser Start

        #Parser End

        #Logic
        if($fullscreen) $fscr=' allowfullscreen'; else $fscr='';

        return '<iframe src="https://vk.com/video_ext.php?oid=somevar&id=another&hash=andanother&sd" width="'.$width.'" height="'.$height.'" frameborder="0" '.$fscr.'></iframe>';
    }

    function rtVideo($vCode)
    {
        $params = $this->params;

        $width = $params->get('width', 432);
        $height = $params->get('height', 243);
        $fullscreen = $params->get('fullscreen', 1);
        $startin = 0;

        #Logic
        if($fullscreen) $fscr=' webkitallowfullscreen mozallowfullscreen allowfullscreen'; else $fscr='';

        return '<iframe width="'.$width.'" height="'.$height.'" src="https://rutube.ru/play/embed/'.$vCode.'" frameborder="0" '.$fscr.'></iframe>';
    }

    function vimeoVideo($vCode)
    {
        $params = $this->params;

        $width = $params->get('width', 432);
        $height = $params->get('height', 243);
        $fullscreen = $params->get('fullscreen', 1);

        #Logic
        if($fullscreen) $fscr=' webkitallowfullscreen mozallowfullscreen allowfullscreen'; else $fscr='';

        return '<iframe src="https://player.vimeo.com/video/'.$vCode.'?title=0&byline=0&portrait=0&badge=0" width="'.$width.'" height="'.$height.'" frameborder="0" '.$fscr.'></iframe>';
    }

    function dmVideo($vCode)
    {
        $params = $this->params;

        $width = $params->get('width', 432);
        $height = $params->get('height', 243);
        $fullscreen = $params->get('fullscreen', 1);

        #Logic
        if($fullscreen) $fscr=' allowfullscreen'; else $fscr='';

        return '<iframe frameborder="0" width="'.$width.'" height="'.$height.'" src="//www.dailymotion.com/embed/video/'.$vCode.'?autoPlay=1&start=90" '.$fscr.'></iframe><iframe frameborder="0" width="480" height="270" src="//www.dailymotion.com/embed/video/x38nftj?autoPlay=1&start=90" allowfullscreen></iframe>';
    }

    function flVideo($vCode)
    {
        $params = $this->params;

        $width = $params->get('width', 432);
        $height = $params->get('height', 243);
        $flheader = $params->get('flheader', 0);
        $flfooter = $params->get('flfooter', 0);
        $flcontext = $params->get('flfooter', 0);

        #Logic
        $flvars='';
        if($flheader) $flvars=$flvars.'data-header="true"';
        if($flfooter) $flvars=$flvars.'data-footer="true"';
        if($flcontext) $flvars=$flvars.'data-context="true"';

        return '<a data-flickr-embed="true" '.$flvars.'  href="https://www.flickr.com/photos/137485300@N04/28985161313/in/pool-flickrvideo/"><img src="https://c2.staticflickr.com/9/8391/28985161313_533eff3767_b.jpg" width="'.$width.'" height="'.$height.'"></a><script async src="https://embedr.flickr.com/assets/client-code.js" charset="utf-8"></script>';
    }

    function vineVideo($vCode)
    {
        $params = $this->params;

        $width = $params->get('width', 600);
        $height = $params->get('height', 600);
        $fullscreen = $params->get('fullscreen', 1);
        $postcard = $params->get('postcard', 1);
        $audio = $params->get('audio', 1);

        #Logic
        if($fullscreen) $fscr=' allowfullscreen'; else $fscr='';

        return '<iframe src="https://vine.co/v/51QrnWbpPbj/embed/simple" width="600" height="600" frameborder="0"></iframe><script src="https://platform.vine.co/static/scripts/embed.js"></script>';
        <iframe src="https://vine.co/v/51QrnWbpPbj/embed/postcard?audio=1" width="600" height="600" frameborder="0"></iframe><script src="https://platform.vine.co/static/scripts/embed.js"></script>
    }

    function scVideo($vCode)
    {
        $params = $this->params;

        $width = $params->get('width', 432);
        $height = $params->get('height', 243);
        $autoplay = $params->get('scautoplay', 0);
        $hide_related = $params->get('scautoplay', 0);
        $show_comments = $params->get('autoplay', 0);
        $show_user = $params->get('autoplay', 1);
        $show_reposts = $params->get('autoplay', 1);
        $visual = $params->get('autoplay', 1);

        #Logic
        $scvars='';
        if($autoplay) $scvars=$scvars.'auto_play=true&amp;'; else $scvars=$scvars.'auto_play=false&amp;';
        if($hide_related) $scvars=$scvars.'hide_related=true&amp;'; else $scvars=$scvars.'hide_related=false&amp;';
        if($show_comments) $scvars=$scvars.'show_comments=true&amp;'; else $scvars=$scvars.'show_comments=false&amp;';
        if($show_user) $scvars=$scvars.'show_user=true&amp;'; else $scvars=$scvars.'show_user=false&amp;';
        if($show_reposts) $scvars=$scvars.'show_reposts=true&amp;'; else $scvars=$scvars.'show_reposts=false&amp;';
        if($visual) $scvars=$scvars.'visual=true&amp;'; else $scvars=$scvars.'visual=false&amp;';

        return '<iframe width="'.$width.'" height="'.$height.'" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/242660009&amp;'.$scvars.'></iframe>';
    }
}
