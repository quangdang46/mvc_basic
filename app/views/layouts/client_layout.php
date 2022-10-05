<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/clients/assets/css/app.css">
  <title>Document</title>
</head>

<body>
  <?php $this->render("blocks/header"); ?>
  <?php $this->render($content); ?>
  <?php $this->render("blocks/footer"); ?>

  <script src="<?php echo _WEB_ROOT ?>/public/clients/assets/js/main.js
  "></script>
</body>

</html>