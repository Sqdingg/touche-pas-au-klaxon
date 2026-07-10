<?php require __DIR__ . '/../layouts/header.php'; ?>
<h1 class="mb-4">Gestion des agences</h1>

<!-- Formulaire de création -->
<form method="post" action="/admin/agences/creer" class="row g-2 mb-4" style="max-width:500px;">
  <div class="col-8">
    <input type="text" name="ville" class="form-control" placeholder="Nom de la nouvelle ville" required>
  </div>
  <div class="col-4">
    <button class="btn btn-success w-100">Ajouter</button>
  </div>
</form>

<!-- Liste des agences -->
<table class="table table-striped">
  <thead>
    <tr>
      <th>Ville</th>
      <th style="width:320px;"></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($agences as $a): ?>
    <tr>
      <td>
        <!-- Formulaire de modification -->
        <form method="post" action="/admin/agences/<?= $a['id_agence'] ?>/modifier" class="d-flex gap-2">
          <input type="text" name="ville" value="<?= htmlspecialchars($a['ville']) ?>" class="form-control form-control-sm">
      </td>
      <td>
          <button class="btn btn-sm btn-secondary">Enregistrer</button>
        </form>
        <form method="post" action="/admin/agences/<?= $a['id_agence'] ?>/supprimer" class="d-inline">
          <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette agence ?')">Supprimer</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<?php require __DIR__ . '/../layouts/footer.php'; ?>