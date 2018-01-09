<?php
/**
 * Created by PhpStorm.
 * User: ASW
 * Date: 18/11/2017
 * Time: 10:31
 */
$navn = $_POST["navn"];
$X1= $_POST["x1"];
$X2=$_POST["x2"];
$X3=$_POST["x3"];
$X4=$_POST["x4"];

$data = array("Navn"=>$navn, "X1"=>$X1, "X2"=>$X2, "X3"=> $X3, "X4"=> $X4);
$data_string = json_encode($data);

try{
$uri = "http://restwebservicetemplate20180108090004.azurewebsites.net/Service1.svc/XXes";
$ch = curl_init($uri);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST" );
curl_setopt($ch,CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type:application/json',
    'Content-Length: ' .strlen($data_string)
));

$jsondata= curl_exec($ch);
$theNewXX = json_decode($jsondata,true);

$XXArray = array($theNewXX);

require_once '../vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader,array(
    'auto_reload'=>true
));

$template = $twig->loadTemplate('XXviewResult.html.twig');

$parametersToTwig = array("XXes"=>$XXArray);
echo $template->render($parametersToTwig);
} catch(SoapFault $exception){
    print_r($exception->getMessage());
}