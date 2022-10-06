<?php
class App
{
  private $__controller, $__action, $__params, $__routes;

  function __construct()
  {
    global $routers;
    if (!empty($routers['default_controller'])) {
      $this->__controller = $routers['default_controller'];
    }
    $this->__action = "index";
    $this->__params = [];
    $this->__routes = new Route();
    $this->handleUrl();
  }
  public function getUrl()
  {

    if (!empty($_SERVER['REQUEST_URI'])) {

      return $_SERVER['REQUEST_URI'];
    }
    return "/";
  }

  public function handleUrl()
  {


    $url = $this->getUrl();
    $data = $this->__routes->handleRoute($url);
    extract($data);
    $url = $path;
    // echo $url;
    $urlArr = array_filter(explode("/", $url));
    if ($active != 1) {
      unset($urlArr[0]);
    }
    $urlArr = array_values($urlArr);
    // echo "<pre>";
    // print_r($urlArr);
    // echo "</pre>";


    //check url co la thu muc hay class

    $urlCheck = "";

    foreach ($urlArr as $key => $item) {
      $urlCheck .= $item . "/";
      $fileCheck = strtolower(rtrim($urlCheck, '/'));
      // //tach thanh mang

      $fileArr = explode("/", $fileCheck);
      //in hoa phan tu cuoi
      $fileArr[count($fileArr) - 1] = ucfirst($fileArr[count($fileArr) - 1]);
      //noi lai
      $fileCheck = implode("/", $fileArr);
      // echo $fileCheck."</br>";
      //kiem tra
      if (!empty($urlArr[$key - 1])) {
        unset($urlArr[$key - 1]);
      }
      if (file_exists("app/controllers/" . ($fileCheck) . ".php")) {
        $urlCheck = $fileCheck;
        break;
      }
    }
    // echo $urlCheck;
    $urlArr = array_values($urlArr);
    // echo "<pre>";
    // print_r($urlArr);
    // echo "</pre>";

    //xu li controller
    if (!empty($urlArr[0])) {
      $this->__controller = ucfirst($urlArr[0]);
      unset($urlArr[0]);
    } else {
      $this->__controller = ucfirst($this->__controller);
    }

    if (empty($urlCheck)) {
      $urlCheck = $this->__controller;
    }
    if (file_exists("app/controllers/" . ($urlCheck) . ".php")) {
      require_once("controllers/" . ($urlCheck) . ".php");
      //kiem tra class ton tai
      if (class_exists($this->__controller)) {
        $this->__controller = new $this->__controller();
      } else {
        $this->loadErrors();
      }
    } else {
      $this->loadErrors();
    }
    //xu li action


    if (!empty($urlArr[1])) {
      $this->__action = $urlArr[1];
      unset($urlArr[1]);
    }

    //xu li __params
    $this->__params = array_values($urlArr);
    //kiem tra method ton tai
    if (method_exists($this->__controller, $this->__action)) {
      call_user_func_array([$this->__controller, $this->__action], $this->__params);
    } else {
      $this->loadErrors();
    }
  }

  public function loadErrors($name = "404")
  {
    require_once "errors/" . $name . ".php";
  }
}
