<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $this->getSiteTitle(); ?></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?=PROJECT_ROOT;?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=PROJECT_ROOT;?>css/custom.css">
    <script src="<?= PROJECT_ROOT;?>js/jquery-3.3.1.min.js"></script>
    <script src="<?= PROJECT_ROOT;?>js/bootstrap.min.js"></script>
    <?= $this->content('head'); ?>
</head>

<body>
    <?= $this->content('body');  ?>
</body>
</html> 