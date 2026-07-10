<?php require __DIR__ . '/../layouts/header.php'; ?>
<h1 class="mb-4">Gestion des trajets</h1>

<table class="table table-striped">
  <thead>
    <tr>
      <th>Départ</th>
      <th>Date départ</th>
      <th>Arrivée</th>
      <th>Date arrivée</th>
      <th>Places dispo. / total</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($trajets as $t): ?>
    <tr>
      <td><?= htmlspecialchars($t['ville_depart']) ?></td>
      <td><?= htmlspecialchars($t['gdh_depart']) ?></td>
      <td><?= htmlspecialchars($t['ville_arrivee']) ?></td>
      <td><?= htmlspecialchars($t['gdh_arrivee']) ?></td>
      <td><?= (int) $t['nb_places_disponibles'] ?> / <?= (int) $t['nb_places_total'] ?></td>
      <td>
        <form method="post" action="/admin/trajets/<?= $t['id_trajet'] ?>/supprimer">
          <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce trajet ?')">Supprimer</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<?php require __DIR__ . '/../layouts/footer.php'; ?>