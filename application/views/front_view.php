<h3>Últimas ofertas:</h3>

<table border="1">
<thead>
    <th>ID</th>
    <th>Título</th>
    <th>Descripción</th>
    <th>Fecha</th>
</thead>
<tbody>

<div class="offer">
    <p class="offer_title">Analista programador</p>
    <div class="offer_tags">
        <p class="offer_company"></p>
        <p class="offer_location"></p>
        <p class="offer_date"></p>
    </div>
    <div class="offer_description">
        <p>
            Requerimos incorporar a nuestro equipo de profesionales, un Analista Programador 
            JAVA para trabajar en Valladolid. KRELL CONSULTING es una compañía de consultoría 
            tecnológica y ... 
        </p>
    </div>

</div>


<?php foreach($offers as $offer) { ?>
    <tr>
        <td><?= $offer->offer_id ?></td>
        <td><?= $offer->offer_title ?></td>
        <td><?= $offer->offer_description ?></td>
        <td><?= $offer->offer_date ?></td>
    </tr>
<?php } ?>
</tbody>
</table>