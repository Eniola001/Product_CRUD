<?php

namespace app\models;
use app\Database;
use app\utilies\pathGenerator;

class Product
{
  public ?int $id = null;
  public ?string $title = null;
  public ?string $description = null;
  public ?float $price = null;
  public ?array $imageFile = null;
  public ?string $imagePath = null;

  public function load($data)
  {
    $this->id = $data['id'] ?? null;
    $this->title = $data['Title'];
    $this->description = $data['Description'] ?? '';
    $this->price = (float)$data['Price'];
    $this->imageFile = $data['imageFile'] ?? null;
    $this->imagePath = $data['image'] ?? null;
  }


  public function save()
  {
    $errors = [];
    if (!is_dir(__DIR__ . '/../public/images')) {
      mkdir(__DIR__ . '/../public/images');
    }

    if (!$this->title) {
      $errors[] = 'Product title is required';
    }

    if (!$this->price) {
      $errors[] = 'Product price is required';
    }

    if (empty($errors)) {
      if ($this->imageFile && $this->imageFile['tmp_name']) {
        if ($this->imagePath) {
          unlink(__DIR__ . '/../public/' . $this->imagePath);
        }
        $this->imagePath = 'images/' . pathGenerator::randomString(8) . '/' . $this->imageFile['name'];
        mkdir(dirname(__DIR__ . '/../public/' . $this->imagePath));
        move_uploaded_file($this->imageFile['tmp_name'], __DIR__ . '/../public/' . $this->imagePath);
      }

      $db = Database::$db;
      if ($this->id) {
        $db->updateProduct($this);
      } else {
        $db->createProduct($this);
      }
    }
    return $errors;
  }
}
