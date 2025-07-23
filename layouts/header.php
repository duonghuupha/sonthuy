<!DOCTYPE html>
<html lang="en">

<?php
if(!isset($_SESSION['data'])){
    header("Location: ".URL.'/index/logout');
}
?>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>SONTHUY EDUCATION</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <link rel="stylesheet" href="<?php echo URL ?>/styles/assets/css/roboto.css" />
    <link rel="stylesheet" href="<?php echo URL ?>/styles/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo URL ?>/styles/assets/css/select2.min.css" />
    <link rel="stylesheet" href="<?php echo URL ?>/styles/assets/css/jquery-ui.custom.min.css" />
    <link rel="stylesheet" href="<?php echo URL ?>/styles/assets/css/jquery-ui.min.css" />
    <link rel="stylesheet" href="<?php echo URL ?>/styles/assets/font-awesome/4.5.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo URL ?>/styles/assets/css/jquery.toast.css" />
    <link rel="stylesheet" href="<?php echo URL ?>/styles/assets/css/chosen.min.css" />
    <link rel="stylesheet" href="<?php echo URL ?>/styles/assets/css/bootstrap-datepicker3.min.css" />
    <link rel="stylesheet" href="<?php echo URL ?>/styles/assets/css/ui.jqgrid.min.css" />
    <link rel="stylesheet" href="<?php echo URL ?>/styles/assets/css/bootstrap-timepicker.min.css" />
    <link rel="stylesheet" href="<?php echo URL ?>/styles/assets/css/ace.min.css" />
    <link rel="stylesheet" href="<?php echo URL ?>/styles/assets/css/ace-skins.min.css" />
    <link rel="stylesheet" href="<?php echo URL ?>/styles/assets/css/ace-rtl.min.css" />
    <link rel="shortcut icon" href="<?php echo URL ?>/styles/assets/images/logo_son_thuy.png" />
    <script src="<?php echo URL ?>/styles/assets/js/jquery-2.1.4.min.js"></script>
    <script src="<?php echo URL ?>/styles/assets/js/ace-extra.min.js"></script>
    <script>
        var baseUrl = '<?php echo URL ?>';
    </script>
    <script src="<?php echo URL ?>/public/scripts/javascript/properties.js"></script>
    <script src="<?php echo URL ?>/public/scripts/javascript/event.js"></script>
</head>

<body class="no-skin">
    <!--BEGIN navbar-->
    <?php include('navbar.php') ?>
    <!--END navbar-->
    <div class="main-container ace-save-state" id="main-container">
        <!--BEGIN sidebar-->
        <?php include('sidebar.php') ?>
        <!--END sidebar-->
        
        
