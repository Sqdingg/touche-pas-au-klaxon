<?php require __DIR__ . '/../layouts/header.php'; ?>
<h1 class="mb-4">Trajets disponibles</h1>
<table class="table table-striped">
  <thead><tr><th>Départ</th><th>Date départ</th><th>Arrivée</th><th>Date arrivée</th><th>Places</th><th></th></tr></thead>
  <tbody>
  <?php foreach ($trajets as $t): ?>
    <tr>
      <td><?= htmlspecialchars($t['ville_depart']) ?></td>
      <td><?= htmlspecialchars($t['gdh_depart']) ?></td>
      <td><?= htmlspecialchars($t['ville_arrivee']) ?></td>
      <td><?= htmlspecialchars($t['gdh_arrivee']) ?></td>
      <td><?= (int) $t['nb_places_disponibles'] ?></td>
      <td>
        <?php if (isset($_SESSION['user'])): ?>
          <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal<?= $t['id_trajet'] ?>">Détails</button>
          <?php if ($_SESSION['user']['id'] == $t['id_employe']): ?>
            <a href="/trajet/<?= $t['id_trajet'] ?>/modifier" class="btn btn-sm btn-secondary">Modifier</a>
            <form method="post" action="/trajet/<?= $t['id_trajet'] ?>/supprimer" class="d-inline">
              <button class="btn btn-sm btn-danger" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
            </form>
          <?php endif; ?>
        <?php endif; ?>
      </td>
    </tr>
    <?php if (isset($_SESSION['user'])): ?>
    <div class="modal fade" id="modal<?= $t['id_trajet'] ?>" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header"><h5 class="modal-title">Détails du trajet</h5>
            <button class="btn-close" data-bs-dismiss="modal"></button></div>
          <div class="modal-body">
            <p><strong>Proposé par :</strong> <?= htmlspecialchars($t['prenom'] . ' ' . $t['nom']) ?></p>
            <p><strong>Téléphone :</strong> <?= htmlspecialchars($t['telephone']) ?></p>
            <p><strong>Email :</strong> <?= htmlspecialchars($t['email']) ?></p>
            <p><strong>Places totales :</strong> <?= (int) $t['nb_places_total'] ?></p>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
  <?php endforeach; ?>
  </tbody>
</table>
<?php require __DIR__ . '/../layouts/footer.php'; ?>