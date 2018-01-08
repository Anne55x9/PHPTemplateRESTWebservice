<?php
/**
 * Created by PhpStorm.
 * User: ASW
 * Date: 18/11/2017
 * Time: 10:32
 */

$uri = "http://restwebservicetemplate20180108090004.azurewebsites.net/Service1.svc/XXes/";
$id = $_POST['id'];
$full_uri = $uri . $id;

$ch = curl_init($full_uri);

curl_setopt($ch,CURLOPT_CUSTOMREQUEST,"DELETE");
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

$jsondata = curl_exec($ch);
$theDeletedXX = json_decode($jsondata,true);

if($theDeletedXX == null){
    $XXArray = false;
}else{
    $XXArray = array($theDeletedXX);
}


require_once '../vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader,array(
    'auto_reload'=> true
));

$template = $twig->loadTemplate('XXviewResult.html.twig');

$parametersToTwig = array("XXes"=> $XXArray);
echo $template->render($parametersToTwig);