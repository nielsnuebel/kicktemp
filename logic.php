<?php defined('_JEXEC') or die;

// variables
$app 		= JFactory::getApplication();
$doc 		= JFactory::getDocument();
$params 	= $app->getParams();
$headdata 	= $doc->getHeadData();
$menu 		= $app->getMenu();
$active 	= $app->getMenu()->getActive();
$pageclass 	= $params->get('pageclass_sfx');
$tpath 		= $this->baseurl.'/templates/'.$this->template;

// parameter
$modernizr 	= $this->params->get('modernizr');
$cssmethod 	= $this->params->get('cssmethod');

$bootstrap 	= $this->params->get('bootstrap');
$fontawesome	= $this->params->get('fontawesome');
$jquery 	= $this->params->get('jquery');
$pie 		= $this->params->get('pie');
$googlefont = $this->params->get('googlefont');
$loadjqueryfirst = $this->params->get('loadjqueryfirst');

// advanced parameter
if ($app->isSite()) {
  // disable js
  if ( $this->params->get('disablejs') ) {
    $fnjs=$this->params->get('fnjs');
    if (trim($fnjs) != '') {
      $filesjs=explode(',', $fnjs);
      $head = (array) $headdata['scripts'];
      $newhead = array();         
      foreach($head as $key => $elm) {
        $add = true;
        foreach ($filesjs as $dis) {
          if (strpos($key,$dis) !== false) {
            $add=false;
            break;
          } 
        }
        if ($add) $newhead[$key] = $elm;
      }
      $headdata['scripts'] = $newhead;
    } 
  } 
  // disable css
  if ( $this->params->get('disablecss') ) {
    $fncss=$this->params->get('fncss');
    if (trim($fncss) != '') {
      $filescss=explode(',', $fncss);
      $head = (array) $headdata['styleSheets'];
      $newhead = array();         
      foreach($head as $key => $elm) {
        $add = true;
        foreach ($filescss as $dis) {
          if (strpos($key,$dis) !== false) {
            $add=false;
            break;
          } 
        }
        if ($add) $newhead[$key] = $elm;
      }
      $headdata['styleSheets'] = $newhead;
    } 
  }
  $doc->setHeadData($headdata); 
}

// generator tag
$this->setGenerator(null);

// force latest IE & chrome frame
$doc->setMetadata('x-ua-compatible', 'IE=edge,chrome=1');

// add javascripts
if ($modernizr==1) $doc->addScript($tpath.'/js/modernizr-2.6.2.js');
if ($bootstrap==1 && JVERSION>='3') :
  JHtml::_('bootstrap.framework');
elseif ($bootstrap==1) :
  $doc->addScript($tpath.'/js/jquery-1.10.2.min.js');
  $doc->addScript($tpath.'/js/jquery-noconflict.js');
  $doc->addScript($tpath.'/js/bootstrap.min.js');
endif;
if ($jquery==1) $doc->addScript($tpath.'/js/jquery-1.10.2.min.js');
if ($jquery==1 or $bootstrap==1 ) {
	$doc->addScript($tpath.'/js/jquery-css-transform.js');
	$doc->addScript($tpath.'/js/script.js');
}

// load jQuery first
if (($bootstrap==1 or $jquery==1) and $loadjqueryfirst):
	//jquery path
	if (JVERSION>='3' && $jquery==0) :
		$jquerypath = $this->baseurl.'/media/jui/js/jquery.min.js';
	elseif ($bootstrap==1 || $jquery==1) :
		$jquerypath = $tpath.'/js/jquery-1.10.2.min.js';
	endif;

	$tmpScripts = array();
	$tmpScripts = $doc->_scripts;
	unset( $tmpScripts[$this->baseurl.'/media/cck/scripts/jquery/js/jquery-1.8.3.min.js'] );
	unset( $tmpScripts[$this->baseurl.'/media/widgetkit/js/jquery.js'] );
	if ($jquery==1 && JVERSION>='3') unset( $tmpScripts[$this->baseurl.'/media/jui/js/jquery.min.js'] );

	$neuScript = array();
	$neuScript[$jquerypath] = $tmpScripts[$jquerypath];
	foreach($tmpScripts as $key=> $value){
		if($key != $jquerypath)
			$neuScript[$key] = $value;
	}
	$doc->_scripts = $neuScript;
endif;


// add stylesheets
if ($cssmethod=='css') : 
  if ($bootstrap==0) $doc->addStyleSheet($tpath.'/css/normalize.css');
  if ($bootstrap==1) :
    $doc->addStyleSheet($tpath.'/css/bootstrap.min.css');
    if ($fontawesome==1) $doc->addStyleSheet($tpath.'/css/font-awesome.min.css');
  endif;
endif;

// add google font
if ($googlefont !='') $doc->addStyleSheet("https://fonts.googleapis.com/css?family=".$googlefont);

// file ending
if ($cssmethod=='min') : 
  $ext = '.php'; 
  $cssmethod = 'css';
else :
  $ext = '';
endif;

// add template sheet
$doc->addStyleSheet($tpath.'/'.$cssmethod.'/template.css'.$ext.'?b='.$bootstrap.'&amp;fa='.$fontawesome.'&amp;v=1');



?>