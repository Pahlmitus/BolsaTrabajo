<div id="register_content">
        <h2>¡Hola! ¿Cómo podemos ayudarte?</h2>
        <p>
                ¿Buscas trabajo en tu sector? ¡Estás de suerte! Tenemos un montón de empresa que buscan
                un perfil como el tuyo. ¿Cómo dices? ¿Que lo que buscas son trabajadores para tu empresa? ¡Pues
                hoy es tu día! Cientos de usuarios se registran a diario en la <a href="<?= base_url('/'); ?>">Bolsa
                de Trabajo</a> buscando una
                empresa innovadora como la tuya.
                <br /><br />
                Ambos registros te crearán un <strong>Usuario</strong> en la <a href="<?= base_url('/'); ?>">Bolsa
                de Trabajo</a>. Si te registras como <i>Trabajador</i>, tu usuario figurará en la lista de
                <strong>Candidatos</strong>. Si lo haces como <i>Empresario</i>, se creará una
                <strong>Empresa</strong> asociada a tu <strong>Usuario</strong>, además de tener tu propia página
                personal.
                <br /><br />
                Pero espera, ¿y qué pasa si quiero ser <i>las dos cosas</i>? ¡Ningún problema! Si así lo deseas,
                puedes registrarte primero como <i>Trabajador</i> y luego dar de alta tu <strong>Empresa</strong>
                como <i>Empresario</i>, y viceversa. En este caso, en tu página personal figurará tu candidatura
                y tu(s) empresa(s).
                <br /><br />
                Sí, has leído bien. Puedes <u>tener más de una empresa</u> asociadas a tu <strong>Usuario</strong>.
                Genial, ¿no? Sin embargo, sólo puedes tener un único perfil de <strong>Candidato</strong>. Tranquilo/a,
                puedes poner todas las competencias, estudios, etc. que desees. Simplemente es para evitar
                <a href="#">candidatos duplicados</a> (esto puede causar una imagen equivocada de tu persona,
                así como errores en nuestro servidor :) ).
        </p>
        <?php if (isset($_GET['err'])) { ?>
                <div class="alert alert-danger" role="alert" id="register_error">
                <b>Error:</b> El email ya está en uso. <i>¿Has olvidado tu <a href="#">contraseña</a></i>?
                </div>
        <?php } ?>
        <div id="register_options">
                <div id="reg_opt_trabajador" onclick="switchRegOpt('trabajador')">
                        <p id="reg_opt_trabajador_text">Soy un trabajador y busco empresa.</p>
                        <form id="reg_opt_trabajador_form" action="<?= base_url('/register/trabajador'); ?>" method="POST" autocomplete="off">
                                <div class="form-group">
                                        <label for="trabajador_email">Email: </label>
                                        <input type="email" class="form-control" id="trabajador_email" name="trabajador_email" required />
                                        <br />
                                        <label for="trabajador_passwd">Contraseña: </label>
                                        <input type="password" class="form-control" id="trabajador_passwd" name="trabajador_passwd" required />
                                        <small onclick="showPass('trabajador_passwd');">Mostrar</small>
                                        <br /><br />
                                        <input type="Submit" value="Registrarse" />
                                </div>
                                <div class="form-group">
                                        <label for="trabajador_firstname">Nombre: </label>
                                        <input type="text" class="form-control" id="trabajador_firstname" name="trabajador_firstname" required />
                                        <br />
                                        <label for="trabajador_lastname">Apellido(s): </label>
                                        <input type="text" class="form-control" id="trabajador_lastname" name="trabajador_lastname" required />
                                </div>
                        </form>
                </div>
                <div id="reg_opt_empresario" onclick="switchRegOpt('empresario')">
                        <p id="reg_opt_empresario_text">Soy un empresario y busco trabajadores.</p>
                        <form id="reg_opt_empresario_form" action="<?= base_url('/register/empresario'); ?>" method="POST" autocomplete="off">
                                <div class="form-group">
                                        <label for="empresario_email">Email: </label>
                                        <input type="email" class="form-control" id="empresario_email" name="empresario_email" required />
                                        <br />
                                        <label for="empresario_passwd">Contraseña: </label>
                                        <input type="password" class="form-control" id="empresario_passwd" name="empresario_passwd" required />
                                        <small onclick="showPass('empresario_passwd');">Mostrar</small>
                                        <br /><br />
                                        <label for="empresario_company">Nombre de la empresa: </label>
                                        <input type="text" class="form-control" id="empresario_company" name="empresario_company" required />
                                </div>
                                <div class="form-group">
                                        <label for="empresario_firstname">Nombre: </label>
                                        <input type="text" class="form-control" id="empresario_firstname" name="empresario_firstname" required />
                                        <br />
                                        <label for="empresario_lastname">Apellido(s): </label>
                                        <input type="text" class="form-control" id="empresario_lastname" name="empresario_lastname" required />
                                        <br />
                                        <input type="Submit" value="Registrarse" />
                                </div>
                        </form>
                </div>
        </div>
</div>