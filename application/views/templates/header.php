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

<!-- Barra de herramientas (admin y usuario) -->
<?php if ($this->session->userdata('logged_in') === 1) { ?>
    <div id="user_bar">
        <div id="bienvenida">Bienvenido/a, <b><?php print_r($this->session->userdata('user_firstname')); ?></b></div>
        <div id="user_options">
            <ul>
            <!-- Los administradores tienen acceso a las bases de datos -->
            <?php if ($this->session->userdata('user_role_id') == 1) { ?>
                <li><a href="<?php echo site_url('/admin/'); ?>">Admin</a></li>
                <li> | </li>
                <li><a href="<?php echo site_url('/admin/users'); ?>">Usuarios</a></li>
                <li> | </li>
                <li><a href="<?php echo site_url('/admin/companies'); ?>">Empresas</a></li>
                <li> | </li>
                <li><a href="<?php echo site_url('/admin/offers'); ?>">Ofertas</a></li>
                <li> | </li>
                <li><a href="<?php echo site_url('/admin/candidates'); ?>">Candidatos</a></li>
                <li> | </li>
                <li><a href="<?php echo site_url('/admin/studies'); ?>">Estudios</a></li>
                <li> | </li>
                <li><a href="<?php echo site_url('/admin/roles'); ?>">Roles</a></li>
                <li> | </li>
                <li><a href="<?php echo site_url('/logout'); ?>">Cerrar sesión</a></li>
            <?php } else { ?>
                <li><a href="<?php echo site_url('/backoffice'); ?>">Mi perfil</a></li>
                <li> | </li>
                <li><a href="<?php echo site_url('/logout'); ?>">Cerrar sesión</a></li>
            <?php } ?>
            </ul>
        </div>
    </div> 
<?php } ?>

<div id="navbar">
        <a href="<?php echo site_url('/'); ?>">
                <p id="title">Bolsa de trabajo v1.0</p>
        </a>

        <!-- Formulario Login (no loggeados) -->
        <?php if ($this->session->userdata('logged_in') !== 1) { ?>
            <form action="<?php echo site_url("/login")?>" method="POST" id="login_form">
                <input type="text" name="user_email" id="user_email" size="18" placeholder="alguien@algo.com" required />
                <input type="password" name="user_passwd" id="user_passwd" size="18" placeholder="1234, como si lo viera" required />
                <input type="submit" value="Entrar" />
                <span id="register">¿Todavía no tienes cuenta? <a href="<?php echo site_url('/register'); ?>">Regístrarte</a></span>
            </form>
        <?php } ?>
</div>

<div id="main">