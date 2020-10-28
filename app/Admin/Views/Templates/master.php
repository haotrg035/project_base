<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$this->data['meta']['title']?></title>
    <?=$this->renderSection('page-style');?>
</head>

<body>

    <div id="app"></div>
    <input type="hidden" id="app-data" value='<?=json_encode($this->data)?>'>

    <script>
    const appData = document.getElementById('app-data');
    console.log(JSON.parse(appData.value));
    </script>
    <?=$this->renderSection('page-script');?>
    <!-- <script>
    document.querySelector('body').removeChild(appData);
  </script> -->
</body>

</html>