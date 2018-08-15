<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Thumbnail Gallery - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <!-- Custom styles for this template -->
  <link href="css/thumbnail-gallery.css" rel="stylesheet">

</head>

<body>
<!-- Page Content -->
<div class="container">

  <h1 class="my-4 text-center text-lg-left">Gallery</h1>

  <div class="row text-center text-lg-left">
    <div class="col-md-3" role="complementary">
      <h2>Add image</h2>
      <form action="upload.php" enctype="multipart/form-data" method="POST">
        <input type="file" name="file">
        <input type="submit">
      </form>
    </div>
  </div>

  <div class="row text-center text-lg-left">

      <?php foreach (glob('../images/*') as $image) : ?>
        <div class="col-lg-3 col-md-4 col-xs-6">
          <a href="#" class="d-block mb-4 h-100">
            <img
              class="img-fluid img-thumbnail"
              src="showimage.php?filename=<?php echo urlencode(pathinfo($image, PATHINFO_BASENAME)) ?>"
              alt="">
          </a>
        </div>
      <?php endforeach; ?>

  </div>

</div>
<!-- /.container -->

<!-- Bootstrap core JavaScript -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"
        integrity="sha384-pjaaA8dDz/5BgdFUPX6M/9SUZv4d12SUPF0axWc+VRZkx5xU3daN+lYb49+Ax+Tl"
        crossorigin="anonymous"></script>

</body>

</html>
