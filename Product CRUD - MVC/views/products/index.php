<h1>Product List</h1>
<table class="table">
  <p>
    <a href="/products/create" class="btn btn-success">Add Product</a>
  </p>
  <form>
    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Search for products" name="search" value="<?php echo $search ?>">
      <button class="btn btn-outline-secondary" type="submit">Search</button>
    </div>
  </form>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Title</th>
      <th scope="col">Price</th>
      <th scope="col">Create Date</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($products as $i => $product) { ?>
      <tr>
        <th scope="row">
          <?php echo $i + 1 ?>
        </th>
        <td><img src="<?php echo $product['Image'] ?>" class="product_image" alt="pc-image"></td>
        <td>
          <?php echo $product['Title'] ?>
        </td>
        <td>
          <?php echo $product['Price'] ?>
        </td>
        <td>
          <?php echo $product['Create_Date'] ?>
        </td>
        <td>
          <a href="/products/update?id=<?php echo $product['ID'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
          <form style="display:inline-block" method="POST" action="/products/delete">
            <input type="hidden" name="id" value="<?php echo $product['ID'] ?>">
            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
          </form>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>