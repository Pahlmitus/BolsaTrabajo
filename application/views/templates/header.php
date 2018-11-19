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

<!-- Barra de herramientas del usuario -->
<?php if ($this->session->userdata('logged_in') === 1) { ?>
    <div id="user_bar">
        <div id="bienvenida">Bienvenido/a, <b><?php print_r($this->session->userdata('user_firstname')); ?></b></div>
        <div id="user_options">
            <ul>
                <li>Mi perfil</li>
                <li> | </li>
                <li><a href="<?php echo site_url('/logout'); ?>">Cerrar sesión</a></li>
            </ul>
        </div>
    </div> 
<?php } ?>

<h1>Bolsa de trabajo v1.0</h1>

<!-- Acceso a las bases de datos (sólo admin) -->
<?php if ($this->session->userdata('logged_in') === 1) { ?>
    <p id="crudbar">
        <a href="<?php echo site_url('/'); ?>">Home</a> |
        <a href="<?php echo site_url('/users'); ?>">Usuarios</a> |
        <a href="<?php echo site_url('/companies'); ?>">Empresas</a> |
        <a href="<?php echo site_url('/roles'); ?>">Roles</a>
    </p>
<?php } ?>

<!-- Formulario Login -->
<?php if ($this->session->userdata('logged_in') !== 1) { ?>
    <form action="<?php echo site_url("/login")?>" method="POST">
        <input type="text" name="user_email" id="user_email" size="18" placeholder="alguien@algo.com" required />
        <input type="password" name="user_passwd" id="user_passwd" size="18" placeholder="1234, como si lo viera" required />
        <input type="submit" value="Login" /> 
    </form>
<?php } ?>