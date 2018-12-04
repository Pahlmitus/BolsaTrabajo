<div id="search_sidebar">
    <h4>Buscar</h4>
    <div id="search_bar">
        <input type="text" class="form-control" id="search_textbox" name="search_textbox" placeholder="programador Gandía..." />
        <button id="search_icon" onclick="search('<?php echo base_url()?>')"><i class="icon fa fa-search"></i></button>
    </div>
    <br />
    <div id="search_conditions">
        <button type="button" class="btn btn-light btn-lg btn-block" data-toggle="collapse" data-target="#search_provincia">Provincias</button>
        <div id="search_provincia" class="collapse">
            <!-- Carga dinámicamente las provincias en una lista (cambia dependiendo de los resultados) -->
            <?php 
                $arr = array();
                foreach ($offers as $offer) { 
                    array_push($arr, $offer->offer_location);
                }
                $arr = array_count_values($arr);
                $arr = array_keys($arr);
                foreach ($arr as $location) { ?>
                <a href="<?= base_url('/location/' . $location)?>" type="button" class="btn btn-small btn-block"><?=$location?></a>
            <?php } ?>
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
    <?php if(isset($title)) {echo $title;} ?>
    <?php foreach($offers as $offer) { ?>
            <div class="offer">
                    <?php if (isset($offer->company_logo) && $offer->company_logo !== '') { ?>
                        <img class="company_logo" src="<?php echo site_url('assets/company_logos/' . $offer->company_logo); ?>" />
                    <?php } else { ?>
                        <img class="company_logo" src="<?php echo site_url('assets/company_logos/no_logo.png'); ?>" />
                    <?php } ?>
                    <p class="offer_title"><?= $offer->offer_title ?></p>
                    <div class="offer_info">
                        <p class="offer_company"><?= $offer->company_name ?></p>
                        <p> | </p>
                        <p class="offer_location"><?= $offer->offer_location ?></p>
                        <p> | </p>
                        <p class="offer_date"><?= $offer->offer_date ?></p>
                    </div>
                    <div class="offer_description">
                        <p><?= $offer->offer_description ?></p>
                    </div>
                    <div class="offer_tags">
                        <?php
                            // SI NO NO VA
                            setlocale(LC_ALL, "es_ES.UTF-8");

                            if (isset($offer->offer_tags)) { 
                                echo "<p>Etiquetas:&nbsp;";
                                $tags = explode(",", $offer->offer_tags);
                                foreach ($tags as $tag) {
                                    // Quita los acentos
                                    $tagname = iconv('UTF-8','ASCII//TRANSLIT', $tag);
                                    // Si al quitar los acentos se generan apóstrofes ('), los elimina también
                                    $tagname = str_replace("'", "", $tagname);
                                    // Quita el espacio inicial (si lo hay)
                                    if (substr($tagname, 0, 1) === ' ') {
                                        $tagname = substr($tagname, 1);
                                    }
                                    // Cambia los demás espacios por "_"
                                    $tagname = preg_replace('/\s+/', '_', $tagname);
                                    // Pasa a minúsculas y añade la url
                                    $tagname = base_url('tag/'.strtolower($tagname));
                                    
                                    echo '<a href="' . $tagname . '" class="badge badge-primary">'. $tag .'</a>&nbsp;';
                                }
                                echo "</p>";
                            } else {
                                echo "<p>Sin etiquetas</p>";
                            }
                        ?>
                    </div>
            </div>
    <?php } ?>
</div>