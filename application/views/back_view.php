<div id="back_view">
<h3>Datos personales</h3>
    <table id="datos_personales">
    <tr>
        <td>Nombre</td>
        <td><?=$user[0]->user_firstname?></td>
    </tr>
    <tr>
        <td>Apellido(s)</td>
        <td><?=$user[0]->user_lastname?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><?=$user[0]->user_email?></td>
    </tr>
</table>
<?php if (isset($candidate)) {?>
    <h3>Datos de candidato</h3>
    <table id="datos_candidato">
    <tr>
        <td>Estudios</td>
        <td><?=$studies[0]->studies_description?></td>
    </tr>
    <tr>
        <td>Fecha de nacimiento</td>
        <td><?=$candidate[0]->candidate_birthdate?></td>
    </tr>
    <tr>
        <td>
            Foto
            <small>
                <a href="<?= base_url('/assets/candidate_photos/' . $candidate[0]->candidate_photo) ?>" target="_blank">
                    Ver
                </a>
            </small>
        </td>
        <td><img src="<?= base_url('/assets/candidate_photos/' . $candidate[0]->candidate_photo) ?>" width="200" height="200" /></td>
    </tr>
    <tr>
        <td>
            Currículum Vitae
            <small>
                <a href="<?= base_url('/assets/candidate_cvs/' . $candidate[0]->candidate_cv) ?>" target="_blank">
                    Ver
                </a>
            </small>
        </td>
        <td><embed src="<?= base_url('/assets/candidate_cvs/' . $candidate[0]->candidate_cv) ?>" width="500px" height="200px" /></td>
    </tr>
</table>
<?php } ?>
</div>