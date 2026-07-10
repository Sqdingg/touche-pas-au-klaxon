<?php
namespace App\Controllers;
use App\Models\AgenceModel;
use App\Models\EmployeModel;
use App\Models\TrajetModel;

class AdminController {
    public function dashboard() {
        $this->requireAdmin();
        require __DIR__ . '/../Views/admin/dashboard.php';
    }

    public function listUtilisateurs() {
        $this->requireAdmin();
        $utilisateurs = (new EmployeModel(getPDO()))->findAll();
        require __DIR__ . '/../Views/admin/utilisateurs.php';
    }

    public function listAgences() {
        $this->requireAdmin();
        $agences = (new AgenceModel(getPDO()))->findAll();
        require __DIR__ . '/../Views/admin/agences.php';
    }

    public function storeAgence() {
        $this->requireAdmin();
        (new AgenceModel(getPDO()))->create($_POST['ville']);
        $_SESSION['flash'] = "L'agence a bien été créée.";
        header('Location: /admin/agences');
        exit;
    }

    public function updateAgence($id) {
        $this->requireAdmin();
        (new AgenceModel(getPDO()))->update((int) $id, $_POST['ville']);
        $_SESSION['flash'] = "L'agence a bien été modifiée.";
        header('Location: /admin/agences');
        exit;
    }

    public function destroyAgence($id) {
        $this->requireAdmin();
        (new AgenceModel(getPDO()))->delete((int) $id);
        $_SESSION['flash'] = "L'agence a bien été supprimée.";
        header('Location: /admin/agences');
        exit;
    }

    public function listTrajets() {
        $this->requireAdmin();
        $trajets = (new TrajetModel(getPDO()))->findAll();
        require __DIR__ . '/../Views/admin/trajets.php';
    }

    public function destroyTrajet($id) {
        $this->requireAdmin();
        (new TrajetModel(getPDO()))->delete((int) $id);
        $_SESSION['flash'] = "Le trajet a bien été supprimé.";
        header('Location: /admin/trajets');
        exit;
    }

    private function requireAdmin(): void {
        if (!isset($_SESSION['user']) || !$_SESSION['user']['est_admin']) {
            header('Location: /');
            exit;
        }
    }
}