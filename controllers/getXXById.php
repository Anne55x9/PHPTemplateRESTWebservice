<?php
/**
 * Created by PhpStorm.
 * User: ASW
 * Date: 18/11/2017
 * Time: 10:12
 */
$uri = "http://restwebservicetemplate20180108090004.azurewebsites.net/Service1.svc/XX/";
$id = $_POST['id'];
$jsondata = file_get_contents($uri . $id);
$XX = json_decode($jsondata, true);
if(empty($XX)){
    $XXArray = null;
}
else{
    $XXArray = array($XX);
}require_once '../vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader,array(
    'auto_reload'=> true
));

$template = $twig->loadTemplate('XXviewResult.html.twig');
$parametersToTwig=array("XXes"=>$XXArray);
echo $template->render($parametersToTwig);