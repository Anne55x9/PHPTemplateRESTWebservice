<?php
/**
 * Created by PhpStorm.
 * User: ASW
 * Date: 17/11/2017
 * Time: 10:50
 */

$uri = "http://restwebservicetemplate20180108090004.azurewebsites.net/Service1.svc/XXes";
$jsondata = file_get_contents($uri);

$convertToAssociativeArray = true;
$XXes = json_decode($jsondata,$convertToAssociativeArray);

require_once '../vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader,array('auto_reload'=> true));

$template = $twig->loadTemplate('XXviewResult.html.twig');

#Array skal være identisk med den titel som er givet i twig.view på listen
$parametersToTwig = array("XXes"=>$XXes);
echo $template->render($parametersToTwig);