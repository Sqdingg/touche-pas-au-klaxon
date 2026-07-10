<?php require __DIR__ . '/../layouts/header.php'; ?>
<h1>Connexion</h1>
<?php if (!empty($erreur)): ?><div class="alert alert-danger"><?= htmlspecialchars($erreur) ?></div><?php endif; ?>
<form method="post" action="/connexion" style="max-width:400px;">
  <div class="mb-3"><label class="form-label">Email</label>
    <input type="email" name="email" class="form-control" required></div>
  <div class="mb-3"><label class="form-label">Mot de passe</label>
    <input type="password" name="mot_de_passe" class="form-control" required></div>
  <button class="btn btn-primary">Se connecter</button>
</form>
<?php require __DIR__ . '/../layouts/footer.php'; ?>