<?php

namespace app\controllers;

use app\Router;
use app\models\Product;

class ProductController
{
  public static function index(Router $router)
  {
    $search = $_GET['search'] ?? '';
    $products = $router->db->getProducts($search);
    $router->renderView("products/index", [
      'products' => $products,
      'search' => $search
    ]);
  }
  public static function create(Router $router)
  {
    $errors = [];
    $productData = [
      'Title' => '',
      'Description' => '',
      'Image' => '',
      'Price' => '',
      'ImageFile' => []
    ];

    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
      $productData['Title'] == $_POST['title'];
      $productData['Description'] == $_POST['description'];
      $productData['Price'] == (float)$_POST['price'];
      $productData['ImageFile'] == $_FILES["image"] ?? null;

      $product = new Product();
      $product->load($productData);
      $errors = $product->save();

      if (empty($errors)) {
        header('Location: /products');
        exit;
      }
    }
    $router->renderView("products/create", [
      'product' => $productData,
      'errors' => $errors
    ]);
  }
  public static function update(Router $router)
  {
    $id = $_GET['id'] ?? null;
    if (!$id) {
      header('Location: /products');
      exit;
    }
    $errors = [];
    $productData = $router->db->getProductById($id);

    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
      $productData['Title'] == $_POST['title'];
      $productData['Description'] == $_POST['description'];
      $productData['Price'] == (float)$_POST['price'];
      $productData['imageFile'] == $_FILES["image"] ?? null;

      $product = new Product();
      $product->load($productData);
      $errors = $product->save();

      if (empty($errors)) {
        header('Location: /products');
        exit;
      }
    }

    $router->renderView('products/update', [
      'product' => $productData,
      'errors'=> $errors
    ]);
  }
  public static function delete(Router $router)
  {
    $id = $_POST['id'] ?? null;
    if (!$id) {
      header('Location: /products');
      exit;
    }

    if ($router->db->deleteProduct($id)) {
      header('Location: /products');
      exit;
    }
  }
}
