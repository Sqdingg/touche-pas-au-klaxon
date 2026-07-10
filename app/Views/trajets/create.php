<?php require __DIR__ . '/../layouts/header.php'; ?>
<h1>Proposer un trajet</h1>
<?php if (!empty($errors)): ?>
  <div class="alert alert-danger"><ul class="mb-0"><?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul></div>
<?php endif; ?>
<form method="post" action="/trajet/creer" style="max-width:500px;">
  <div class="mb-3"><label class="form-label">Agence de départ</label>
    <select name="id_agence_depart" class="form-select" required>
      <?php foreach ($agences as $a): ?><option value="<?= $a['id_agence'] ?>"><?= htmlspecialchars($a['ville']) ?></option><?php endforeach; ?>
    </select></div>
  <div class="mb-3"><label class="form-label">Agence d'arrivée</label>
    <select name="id_agence_arrivee" class="form-select" required>
      <?php foreach ($agences as $a): ?><option value="<?= $a['id_agence'] ?>"><?= htmlspecialchars($a['ville']) ?></option><?php endforeach; ?>
    </select></div>
  <div class="mb-3"><label class="form-label">Date/heure de départ</label>
    <input type="datetime-local" name="gdh_depart" class="form-control" required></div>
  <div class="mb-3"><label class="form-label">Date/heure d'arrivée</label>
    <input type="datetime-local" name="gdh_arrivee" class="form-control" required></div>
  <div class="mb-3"><label class="form-label">Nombre de places</label>
    <input type="number" name="nb_places_total" min="1" class="form-control" required></div>
  <p class="text-muted">
    Contact : <?= htmlspecialchars($_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom']) ?>
    — <?= htmlspecialchars($_SESSION['user']['email']) ?>
    — <?= htmlspecialchars($_SESSION['user']['telephone']) ?>
  </p>
  <button class="btn btn-primary">Créer le trajet</button>
</form>
<?php require __DIR__ . '/../layouts/footer.php'; ?>