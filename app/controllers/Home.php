<?php
class Home extends Controller
{
  private $model;
  public function __construct()
  {
    $this->model = $this->model("HomeModel");
  }
  public function index()
  {
    $data = $this->model->getList();
    var_dump($data);
    //render ra view
  }
  public function detail($name)
  {
    echo $name;
  }
}
