<!DOCTYPE html>
<html>
<head>
    <title>Bolsa de trabajo v1.0</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
        if (!!$css_files) { foreach($css_files as $file): ?>
        <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
    <?php endforeach; } ?>
</head>
<body>
<?php print_r($this->session->userdata()); ?>

<h1>Bolsa de trabajo v1.0</h1>
<?php if ($this->session->userdata('logged_in') === 1) { ?>
<p id="adminbar">
    <a href="<?php echo site_url('/'); ?>">Home</a> |
    <a href="<?php echo site_url('/users'); ?>">Usuarios</a> |
    <a href="<?php echo site_url('/companies'); ?>">Empresas</a> |
    <a href="<?php echo site_url('/roles'); ?>">Roles</a> |
    <a href="<?php echo site_url('/logout'); ?>"><b>Salir</b></a>
</p>
<?php } ?>
<?php if ($this->session->userdata('logged_in') !== 1) { ?>
<form action="/login" method="POST">
    <input type="text" name="email" size="16" placeholder="alguien@algo.com" />
    <input type="password" name="pass" size="16" placeholder="1234, como si lo viera" />
    <a href="<?php echo site_url('/login'); ?>">Login</a> 
</form>
<?php } ?>