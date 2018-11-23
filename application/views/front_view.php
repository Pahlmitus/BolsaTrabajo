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
</tbody>
</table>