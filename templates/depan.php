<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?= $title; ?></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="icon"
      type="image/png"
      href="../assets/login/images/icons/favicon.ico"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="../assets/login/vendor/bootstrap/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="../assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="../assets/login/fonts/iconic/css/material-design-iconic-font.min.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="../assets/login/vendor/animate/animate.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="../assets/login/vendor/css-hamburgers/hamburgers.min.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="../assets/login/vendor/animsition/css/animsition.min.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="../assets/login/vendor/select2/select2.min.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="../assets/login/vendor/daterangepicker/daterangepicker.css"
    />
    <link rel="stylesheet" type="text/css" href="../assets/login/css/util.css" />
    <link rel="stylesheet" type="text/css" href="../assets/login/css/main.css" />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />

</head>
<body >
    <div class='limiter'>
      <div class='container-login100' style="background-image: url('../assets/login/images/bg-01.jpg')">
        <?= $content; ?>
      </div>
    </div>


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?= $tt_jihyo ?>
    <script src='../assets/login/vendor/jquery/jquery-3.2.1.min.js'></script>
    <script src='../assets/login/vendor/animsition/js/animsition.min.js'></script>
    <script src='../assets/login/vendor/bootstrap/js/popper.js'></script>
    <script src='../assets/login/vendor/bootstrap/js/bootstrap.min.js'></script>
    <script src='../assets/login/vendor/select2/select2.min.js'></script>
    <script src='../assets/login/vendor/daterangepicker/moment.min.js'></script>
    <script src='../assets/login/vendor/daterangepicker/daterangepicker.js'></script>
    <script src='../assets/login/vendor/countdowntime/countdowntime.js'></script>
    <script src='../assets/login/js/main.js'></script>
  </body>
</html>