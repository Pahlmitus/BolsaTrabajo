<div id="register_content">
        <h2>¡Hola! ¿Cómo podemos ayudarte?</h2>
        <div id="register_options">
                <div id="reg_opt_trabajador" onclick="switchRegOpt('trabajador')">
                        <p id="reg_opt_trabajador_text">Soy un trabajador y busco empresa.</p>
                        <form id="reg_opt_trabajador_form" action="/" method="POST">
                                <div class="form-group">
                                        <label for="trabajador_firstname">Nombre: </label>
                                        <input type="text" class="form-control" id="trabajador_firstname" size="30" />
                                        <br />
                                        <label for="trabajador_lastname">Apellido(s): </label>
                                        <input type="text" class="form-control" id="trabajador_lastname" size="30" />
                                        <br />
                                </div>
                        </form>
                </div>
                <div id="reg_opt_empresario" onclick="switchRegOpt('empresario')">
                        <p id="reg_opt_empresario_text">Soy un empresario y busco trabajadores.</p>
                        <form id="reg_opt_empresario_form" action="/" method="POST">
                                <div class="form-group">
                                        <label for="empresario_firstname">Nombre: </label>
                                        <input type="text" class="form-control" id="empresario_firstname" size="30" />
                                        <br />
                                        <label for="empresario_lastname">Apellido(s): </label>
                                        <input type="text" class="form-control" id="empresario_lastname" size="30" />
                                        <br />
                                </div>
                        </form>
                </div>
        </div>
</div>