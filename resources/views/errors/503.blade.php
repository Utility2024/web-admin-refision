<!doctype html>

<html
  lang="en"
  class="light-style layout-wide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path=""
  data-template="vertical-menu-template-free"
  data-style="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Under Maintenance - 503</title>

    <meta name="description" content="" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="{{ url('vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ url('vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ url('vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ url('css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ url('vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ url('vendor/css/pages/page-misc.css') }}" />

    <!-- Helpers -->
    <script src="{{ url('vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ url('js/config.js') }}"></script>
  </head>

  <body>
    <!-- Content -->

    <!--Under Maintenance -->
    <div class="container-xxl container-p-y">
      <div class="misc-wrapper">
        <h3 class="mb-2 mx-2">Under Maintenance! 🚧</h3>
        <p class="mb-6 mx-2">Sorry for the inconvenience but we're performing some maintenance at the moment</p>
        <!-- <a href="index.html" class="btn btn-primary">Back to home</a> -->
        <div class="mt-6">
          <img
            src="{{ url('images/maintenance.png') }}"
            alt="girl-doing-yoga-light"
            width="500"
            class="img-fluid"
            data-app-light-img="maintenance.png"
            data-app-dark-img="maintenance.png" />
        </div>
      </div>
    </div>
    <!-- /Under Maintenance -->

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="{{ url('vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ url('vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ url('vendor/js/bootstrap.js') }}"></script>
    <script src="{{ url('vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ url('vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ url('js/main.js') }}"></script>

    <!-- Page JS -->

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
