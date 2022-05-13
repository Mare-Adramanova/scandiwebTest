<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <title>Product List</title>
</head>

<body>
  <div class="container">
    <div class="d-flex justify-content-between mt-5">
      <h3>Product List</h2>
        <div class="d-flex justify-content-between">
          <a href="/phpTest/create" class="btn btn-outline-primary btn-lg m-1" role="button" style="height: 45px;">ADD</a>

          <form action="/phpTest/delete" method="post">
            <input onclick="return confirm('Are you sure?')" type="submit" name="delete" class="btn btn-outline-danger btn-block m-1" value="MASS DELETE" role="button" style="height: 45px;">
        </div>
    </div>

    <hr class="mb-5">

    <div class="row g-5">
      <?php  
      foreach ($products as $key => $value) {?>
        <h3><?= $key; ?></h3>

        <?php 
        foreach ($value as $product) {
      ?>
          <div class="col-lg-3">
            <div class="card flex-row flex-wrap">
              <div class="m-3">
                  <label>
                      <input type="checkbox" class="delete-checkbox" name="productType[<?= $product->productType ?>][]" value="<?= $product->id ?>">
                  </label>
              </div>
              <div class="card-body card-block col-lg-8">
                <div class="card-text">
                  <h6 class="text-center"><?= $product->sku ?></h6>
                
                  <h6 class="text-center"><?= $product->name ?></h6>
                  <h6 class="text-center"><?= $product->price ?>,00 $<br></h6>
                  <h6 class="text-center"><?= ($product->productType == "dvd") ? 
                  'Size: ' . $product->size . 'MB' : 
                  (($product->productType == "book") 
                  ? 'Weight: ' . $product->weight . 'KG' 
                  : 'Dimension: ' . $product->height . 'x' . $product->width . 'x' . $product->length) ?><br></h6>
                </div>
              </div>
            </div>
          </div>
      <?php }
      } ?>
      </form>
    </div>
    <hr class="mb-5">
    <?php
    include_once(__DIR__ . '/partials/footer.html');
    ?>