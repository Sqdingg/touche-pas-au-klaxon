<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Covoiturage Inter-Sites</title>
    <link rel="stylesheet" href="/assets/css/custom.css">
</head>
<body>
<nav class="navbar navbar-expand navbar-dark" style="background-color:#00497c;">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Covoiturage Inter-Sites</a>
    <div class="d-flex align-items-center gap-3">
      <?php if (isset($_SESSION['user']) && !$_SESSION['user']['est_admin']): ?>
        <a href="/trajet/creer" class="btn btn-light btn-sm">Proposer un trajet</a>
        <span class="text-white"><?= htmlspecialchars($_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom']) ?></span>
        <a href="/deconnexion" class="btn btn-outline-light btn-sm">Déconnexion</a>
      <?php elseif (isset($_SESSION['user'])): ?>
        <a href="/admin/agences" class="btn btn-outline-light btn-sm">Agences</a>
        <a href="/admin/utilisateurs" class="btn btn-outline-light btn-sm">Utilisateurs</a>
        <a href="/admin/trajets" class="btn btn-outline-light btn-sm">Trajets</a>
        <a href="/deconnexion" class="btn btn-outline-light btn-sm">Déconnexion</a>
      <?php else: ?>
        <a href="/connexion" class="btn btn-light btn-sm">Connexion</a>
      <?php endif; ?>
    </div>
  </div>
</nav>
<div class="container mt-4">
<?php if (isset($_SESSION['flash'])): ?>
  <div class="alert alert-success"><?= htmlspecialchars($_SESSION['flash']) ?></div>
  <?php unset($_SESSION['flash']); ?>
<?php endif; ?>