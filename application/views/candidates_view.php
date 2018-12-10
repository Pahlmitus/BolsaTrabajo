<div id="search_sidebar">
    <h4>Buscar</h4>
    <div id="search_bar">
        <input type="text" class="form-control" id="search_textbox" name="search_textbox" placeholder="Bloqueado por su seguridad" disabled />
        <button id="search_icon" disabled><i class="icon fa fa-search"></i></button>
    </div>
    <br />
</div>

<div id="last_offers">
    <?php if(isset($title)) {echo $title;} ?>
    <?php if(isset($links)) {
        echo $links;  
    } ?>
    <?php foreach($candidates as $candidate) { ?>
        <div class="candidate">
            <table id="datos_personales">
                <tr>
                    <td>
                        <?php echo $candidate->user_firstname . " " . $candidate->user_lastname; ?><br />
                        <a href="<?= base_url('/candidates/profile/' . $candidate->candidate_user_id) ?>"><small>Ver candidato</small></a>
                    </td>
                    <td><img src="<?= base_url('/assets/candidate_photos/' . $candidate->candidate_photo) ?>" width="100" height="100" /></td>
                </tr>    
            </table>
        </div>
    <?php } ?>
    <br />
    <?php if(isset($links)) {
        echo $links;  
    } ?>
</div>