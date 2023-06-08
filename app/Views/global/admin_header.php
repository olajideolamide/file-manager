<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">


  <title>Dashboard Template · Bootstrap v5.3</title>

  <link href="/assets/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="/assets/custom/css/dashboard.css" rel="stylesheet">

  <link href="/assets/fontawesome/css/fontawesome.css" rel="stylesheet">
  <link href="/assets/fontawesome/css/brands.css" rel="stylesheet">
  <link href="/assets/fontawesome/css/solid.css" rel="stylesheet">
  <link href="/assets/fontawesome/css/regular.css" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">

  <link href="/assets/custom/css/style.css" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

</head>

<body>



  <div class="container-fluid px-0 py-0">
    <div class="row " style="--bs-gutter-x: 0rem;">
      <nav id="sidebarMenu" class="col-md-2 d-md-block my-sidebar collapse bg-light">
        <div class="position-sticky pt-3 sidebar-sticky">

          <div class="text-center">
            <img src="assets/custom/images/icon-new-md.png" width="70" />
          </div>

          <?= $this->include('global/sidebar_partials/quick_links') ?>
          <?= $this->include('global/sidebar_partials/usage') ?>
          <?= $this->include('global/sidebar_partials/user') ?>
        </div>
      </nav>



      <main class="col-md-7 ms-sm-auto">