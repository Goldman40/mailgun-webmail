<?php
session_start();

require 'vendor/autoload.php';
require 'app/config.php';

$d = new \app\auth\Session();

if(isset($_GET['a']) && $_GET['a'] == 'unconnect') {
    $_SESSION = array();
}
if(!$d->LookIfUserConnect()) {
    $action = 'auth';
} elseif (!isset($_GET['a'])) {
    $action = 'home';
} else {
    $action = basename($_GET['a']);
}

$class_name = '\app\controller\Controller_'.$action;
$p = new $class_name();
$data['content'] = $p->Call();



$array = array();

$loader = new Twig_Loader_Filesystem('public/template/'.TEMPLATE_NAME.'/');
$twig = new Twig_Environment($loader, array(
    'debug' => true,
    'cache' => false
));

$twig->getExtension('Twig_Extension_Core')->setDateFormat('H:i:s d/m/Y', '%d days');
$twig->getExtension('Twig_Extension_Core')->setTimezone('Europe/Paris');
$twig->addExtension(new Twig_Extension_Debug());

$file = 'pages/' . $action . '.twig';
echo $twig->render($file, $data);