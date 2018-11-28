<div id="search_sidebar">
    <h4>Buscar</h4>
    <div id="search_bar">
        <input type="text" class="form-control" id="search_textbox" name="search_textbox" placeholder="Programador web en Gandía..." />
        <button id="search_icon"><i class="icon fa fa-search"></i></button>
    </div>
    <br />
    <div id="search_conditions">
        <button type="button" class="btn btn-light btn-lg btn-block" data-toggle="collapse" data-target="#search_provincia">Provincia</button>
        <div id="search_provincia" class="collapse">
            <button type="button" class="btn btn-small btn-block">Valencia</button>
            <button type="button" class="btn btn-small btn-block">Madrid</button>
            <button type="button" class="btn btn-small btn-block">Barcelona</button>
        </div>
        <button type="button" class="btn btn-light btn-lg btn-block" data-toggle="collapse" data-target="#search_etiquetas">Etiquetas</button>
        <div id="search_etiquetas" class="collapse">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="search_tags_informatica">
                <label class="form-check-label" for="search_tags_informatica">Informática</label>
                <br />
                <input type="checkbox" class="form-check-input" id="search_tags_construccion">
                <label class="form-check-label" for="search_tags_construccion">Construcción</label>
            </div>
        </div>
    </div>
    
</div>

<div id="last_offers">
    <h3>Últimas ofertas:</h3>

    <?php foreach($offers as $offer) { ?>
            <div class="offer">
                    <?php if (isset($offer->company_logo) && $offer->company_logo !== '') { ?>
                        <img class="company_logo" src="<?php echo site_url('assets/company_logos/' . $offer->company_logo); ?>" />
                    <?php } else { ?>
                        <img class="company_logo" src="<?php echo site_url('assets/company_logos/no_logo.png'); ?>" />
                    <?php } ?>
                    <p class="offer_title"><?= $offer->offer_title ?></p>
                    <div class="offer_tags">
                        <p class="offer_company"><?= $offer->company_name ?></p>
                        <p> | </p>
                        <p class="offer_location"><?= $offer->offer_location ?></p>
                        <p> | </p>
                        <p class="offer_date"><?= $offer->offer_date ?></p>
                    </div>
                    <div class="offer_description">
                        <p><?= $offer->offer_description ?></p>
                    </div>
            </div>
    <?php } ?>
</div>