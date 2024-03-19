<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Local Art</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <style>
    #myVideo {
      position: fixed;
      right: 0;
      bottom: 0;
      min-width: 100%; 
      min-height: 100%;
    }

    .content {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: rgba(0, 0, 0, 0.5);
      color: #f1f1f1;
      padding: 20px;
      max-width: 80%;
      text-align: center;
    }
  </style>
</head>
<body style="height: 100vh; overflow: hidden;">

<video autoplay muted loop id="myVideo" class="w-100">
  <source src="yellow_-_91076 (720p).mp4" type="video/mp4">
  Your browser does not support HTML5 video.
</video>

<div class="content">
  <h1>Local Art</h1>
  <p>The world of handmade crafts is filled with talented artists and artisans who create unique and beautiful products.</p>
  <a class="btn btn-dark" href="seller/login.php">Seller</a>
  <a class="btn btn-dark" href="login.php">Customer</a>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>



</body>
</html>
