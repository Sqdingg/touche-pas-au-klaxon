<?php require __DIR__ . '/../layouts/header.php'; ?>
<h1 class="mb-4">Liste des utilisateurs</h1>

<table class="table table-striped">
  <thead>
    <tr>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Email</th>
      <th>Téléphone</th>
      <th>Rôle</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($utilisateurs as $u): ?>
    <tr>
      <td><?= htmlspecialchars($u['nom']) ?></td>
      <td><?= htmlspecialchars($u['prenom']) ?></td>
      <td><?= htmlspecialchars($u['email']) ?></td>
      <td><?= htmlspecialchars($u['telephone']) ?></td>
      <td>
        <?php if ($u['est_admin']): ?>
          <span class="badge bg-dark">Administrateur</span>
        <?php else: ?>
          <span class="badge bg-secondary">Employé</span>
        <?php endif; ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<?php require __DIR__ . '/../layouts/footer.php'; ?>