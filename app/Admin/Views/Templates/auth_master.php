<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    body {
      background-color: #f3f3f3 !important;
      display: flex;
      justify-content: center;
      align-items: center
    }
  </style>
  <?= $this->renderSection('page-style'); ?>
</head>

<body>
  <div id="app"></div>
  <?= $this->renderSection('page-script'); ?>
</body>

</html>