<?php
class Product  extends Controller
{
  private $model;
  private $data;
  public function __construct()
  {
    $this->model = $this->model("ProductModel");
  }
  public function index()
  {
    echo "success";
    // render view
  }

  public function getList()
  {
    $dataProduct = $this->model->getList();
    $this->data['product_list'] = $dataProduct;


    $this->data['content'] = "products/list";
    $this->render("layouts/client_layout", $this->data);
  }
  public function getDetails()
  {
    $this->render("products/detail");
  }
}
