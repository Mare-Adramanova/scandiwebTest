<!DOCTYPE html>
<html>

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <title>Product add</title>
</head>

<body class="bg-light text-dark">
  <div class="container">
    <form action="/phpTest/create" method="post" id="product-form">
      <div class="d-flex justify-content-between mt-5">
        <h2>Product Add</h2>
        <div>
          <input type="submit" class="btn btn-outline-primary" value="Save" id="product_form">
          <a href="/phpTest/cancel" class="btn btn-outline-warning">Cancel</a>
        </div>
      </div>

      <hr class="mb-5">

      <div class="container p-3">
        <div class="form-group mb-3 mt-3">
          <label for="sku">SKU:</label>
          <input type="text" id="sku" name="sku" class="form-control" required>
        </div>
        <div class="form-group mb-3">
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="form-group mb-3">
          <label for="price">Price:</label>
          <input type="number" id="price" name="price" class="form-control" required>
        </div>
        <div class="form-group mb-3">
          <label for="productTypes">Type Switcher:</label>
          <select id="productTypes" name="productType" onChange="prodType(this.value);" class="form-control" required>
            <option value="">Choose Switcher</option>
            <option value="dvd">DVD</option>
            <option value="book">Book</option>
            <option value="furniture">Furniture</option>
          </select>
        </div>
        <div class="fieldbox" id="dvd_attributes">
          <div class="form-group">
            <label for="size">Size</label>
            <input type="text" name="size" value="" class="form-control" placeholder="size" id="size">
          </div>
          <p>
            <?= "Please provide size in MB for DVD-disc"; ?>
          </p>
        </div>
        <div class="fieldbox" id="book_attributes">
          <div class="form-group">
            <label for="weight">Weight</label>
            <input type="text" name="weight" value="" class="form-control" placeholder="weight 0.000" id="weight">
          </div>
          <p>
            <?= "Please provide weight in Kg"; ?>
          </p>
        </div>
        <div class="fieldbox" id="furniture_attributes">
          <div class="form-group">
            <label for="height">Height</label>
            <input type="text" name="height" class="form-control" id="height">
          </div>
          <div class="form-group">
            <label for="width">Width</label>
            <input type="text" name="width" class="form-control" id="width">
          </div>
          <div class="form-group">
            <label for="lenght">Length</label>
            <input type="text" name="length" class="form-control" id="length">
          </div>
          <p>
            <?= "Please provide dimensions in HxWxL format"; ?>
          </p>
        </div>
    </form>
  </div>
  
  <hr class="mt-5">
  <?php
  include_once(__DIR__ . '/partials/footer.html');
  ?>
  </div>

  <script>
    function prodType(prod) {
      let changedProduct = [
        'dvd',
        'book',
        'furniture'
      ];

      let elements = document.querySelectorAll('[id$="_attributes"]');

      elements.forEach(function(el){
        el.style.display = 'none'
      });

      if (changedProduct.indexOf(prod) >= 0) {
        return changeInput(prod)
      } 
    }

    function changeInput(prod){
        let element = document.querySelector('#'+prod + '_attributes');
        element.style.display = 'block';
        element.setAttribute("required", "required");
    }

      (function validation(){
        var params = new URLSearchParams(location.search)
        params.forEach(function(param, index){
          if(index.length > 0 && param.length == 0){
              let el = document.createElement('p');
              el.style.color = 'red';
              el.innerHTML = 'Is required field: ' + index;
              document.getElementById('product-form').append(el)
          }
          if(param.length > 0){
              let el = document.createElement('p');
              el.style.color = 'red';
              el.innerHTML = param + ': ' + index;
              document.getElementById('product-form').append(el)
          }
          history.replaceState('','','/phpTest/create')
        })
      })()
      
  </script>
  <style type="text/css">
    .fieldbox {
      display: none;
    }
  </style>
</body>

</html>