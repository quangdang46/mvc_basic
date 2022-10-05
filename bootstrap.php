

<?php
define("_DIR_ROOT", __DIR__);

// xu li http root
$web_root = "http://" . $_SERVER['HTTP_HOST'];
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") {
  $web_root = "https://" . $_SERVER['HTTP_HOST'];
}

//lay thu muc chua code
$root = str_replace("\\", "/", _DIR_ROOT);

$folder = str_replace(strtolower($_SERVER['DOCUMENT_ROOT']), "", strtolower($root));
$web_root = $web_root . $folder;
// echo $web_root;
define('_WEB_ROOT', $web_root);



require_once "./configs/routers.php";
require_once "core/Controller.php";
require_once "./app/App.php";

?>