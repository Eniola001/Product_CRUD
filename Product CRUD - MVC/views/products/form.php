<?php if (!empty($errors)) { ?>
  <div class="alert alert-danger">
    <?php foreach ($errors as $error) { ?>
      <div>
        <?php echo $error ?>
      </div>
    <?php } ?>
  </div>
<?php } ?>
<p>
  <a href="/products" class="btn btn-secondary">Back to Products</a>
</p>
<form action="" method="POST" enctype="multipart/form-data">
  <?php if ($product['Title']) { ?>
    <img src="<?php echo $product['Image'] ?>" class="update-image">
  <?php } ?>
  <div class="form-group">
    <label>Product Image</label><br>
    <input type="file" name="image">
  </div>
  <div class="form-group">
    <label>Product Title</label>
    <input type="text" name="title" value="<?php echo $product['Title'] ?>" class="form-control">
  </div>
  <div class="form-group">
    <label>Product Description</label>
    <textarea class="form-control" name="description" value="<?php echo $product['Description'] ?>"></textarea>
  </div>
  <div class="form-group">
    <label>Product Price</label>
    <input type="number" step="0.01" name="price" value="<?php echo $product['Price'] ?>" class="form-control">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>