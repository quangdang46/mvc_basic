<?php
class App
{
  private $__controller, $__action, $__params;

  function __construct()
  {
    global $routers;
    if (!empty($routers['default_controller'])) {
      $this->__controller = $routers['default_controller'];
    }
    $this->__action = "index";
    $this->__params = [];
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
    $urlArr = array_filter(explode("/", $url));
    unset($urlArr[1]);
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
    if (file_exists("app/controllers/" . ($this->__controller) . ".php")) {
      require_once("controllers/" . $this->__controller . ".php");
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
