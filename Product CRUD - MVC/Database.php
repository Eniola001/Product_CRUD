<?php

namespace app;

use app\models\Product;
use PDO;

class Database
{
  public $pdo;
  public static Database $db;
  public function __construct()
  {
    $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=products_crud', 'root', '');
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    self::$db = $this;
  }

  public function getProducts($search = '')
  {
    if ($search) {
      $statement = $this->pdo->prepare('SELECT * FROM products WHERE title LIKE :title ORDER BY Create_Date DESC');
      $statement->bindValue(':title', "%$search%");
    } else {
      $statement = $this->pdo->prepare('SELECT * FROM products ORDER BY Create_Date DESC');
    }
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getProductById($id)
  {
    $statement = $this->pdo->prepare('SELECT * FROM products WHERE id = :id');
    $statement->bindValue(':id', $id);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function createProduct(Product $product)
  {
    $statement = $this->pdo->prepare("INSERT INTO products (Title, Description, Image, Price, Create_Date)
    VALUES (:title,:description, :image, :price, :date)
   ");
    $statement->bindValue(':title', $product->title);
    $statement->bindValue(':image', $product->imagePath);
    $statement->bindValue(':description', $product->description);
    $statement->bindValue(':price', $product->price);
    $statement->bindValue(':date', date('Y-m-d H:i:s'));

    $statement->execute();
  }

  public function deleteProduct($id)
  {
    $statement = $this->pdo->prepare("DELETE FROM products WHERE ID = :id");
    $statement->bindValue(':id', $id);
    $statement->execute();
  }

  public function updateProduct(Product $product)
  {
    $statement = $this->pdo->prepare("UPDATE products SET title = :title, 
                                        image = :image, 
                                        description = :description, 
                                        price = :price WHERE id = :id");
    $statement->bindValue(':title', $product->title);
    $statement->bindValue(':image', $product->imagePath);
    $statement->bindValue(':description', $product->description);
    $statement->bindValue(':price', $product->price);
    $statement->bindValue(':id', $product->id);

    $statement->execute();
  }
}
