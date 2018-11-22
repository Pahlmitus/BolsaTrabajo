<h3>Últimas ofertas:</h3>

<table border="1">
<thead>
    <th>ID</th>
    <th>Título</th>
    <th>Descripción</th>
    <th>Fecha</th>
</thead>
<tbody>
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