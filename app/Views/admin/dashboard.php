<?php require __DIR__ . '/../layouts/header.php'; ?>
<h1 class="mb-4">Tableau de bord administrateur</h1>

<div class="row g-3">
  <div class="col-md-4">
    <div class="card">
      <div class="card-body text-center">
        <h5 class="card-title">Agences</h5>
        <p class="card-text text-muted">Lister, créer, modifier ou supprimer une agence.</p>
        <a href="/admin/agences" class="btn btn-primary">Gérer les agences</a>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-body text-center">
        <h5 class="card-title">Utilisateurs</h5>
        <p class="card-text text-muted">Consulter la liste des employés.</p>
        <a href="/admin/utilisateurs" class="btn btn-primary">Voir les utilisateurs</a>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-body text-center">
        <h5 class="card-title">Trajets</h5>
        <p class="card-text text-muted">Consulter et supprimer les trajets.</p>
        <a href="/admin/trajets" class="btn btn-primary">Gérer les trajets</a>
      </div>
    </div>
  </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>