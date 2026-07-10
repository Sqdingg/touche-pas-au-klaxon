<?php
namespace App\Controllers;
use App\Models\TrajetModel;
use App\Models\AgenceModel;

class TrajetController {
    public function index() {
        $trajets = (new TrajetModel(getPDO()))->findAllDisponibles();
        require __DIR__ . '/../Views/trajets/index.php';
    }

    public function create() {
        $this->requireLogin();
        $agences = (new AgenceModel(getPDO()))->findAll();
        require __DIR__ . '/../Views/trajets/create.php';
    }

    public function store() {
        $this->requireLogin();
        $errors = $this->validate($_POST);

        if (!empty($errors)) {
            $agences = (new AgenceModel(getPDO()))->findAll();
            require __DIR__ . '/../Views/trajets/create.php';
            return;
        }

        $data = $_POST;
        $data['id_employe'] = $_SESSION['user']['id'];
        (new TrajetModel(getPDO()))->create($data);

        $_SESSION['flash'] = "Le trajet a bien été créé.";
        header('Location: /');
        exit;
    }

    public function edit($id) {
        $this->requireLogin();
        $model = new TrajetModel(getPDO());
        $trajet = $model->findById((int) $id);

        if (!$trajet || $trajet['id_employe'] != $_SESSION['user']['id']) {
            header('Location: /');
            exit;
        }
        $agences = (new AgenceModel(getPDO()))->findAll();
        require __DIR__ . '/../Views/trajets/edit.php';
    }

    public function update($id) {
        $this->requireLogin();
        $id = (int) $id;
        $model = new TrajetModel(getPDO());
        $trajet = $model->findById($id);

        if (!$trajet || $trajet['id_employe'] != $_SESSION['user']['id']) {
            header('Location: /');
            exit;
        }

        $errors = $this->validate($_POST);
        if (!empty($errors)) {
            $agences = (new AgenceModel(getPDO()))->findAll();
            require __DIR__ . '/../Views/trajets/edit.php';
            return;
        }

        $model->update($id, $_POST);
        $_SESSION['flash'] = "Le trajet a bien été modifié.";
        header('Location: /');
        exit;
    }

    public function destroy($id) {
        $this->requireLogin();
        $id = (int) $id;
        $model = new TrajetModel(getPDO());
        $trajet = $model->findById($id);

        if ($trajet && $trajet['id_employe'] == $_SESSION['user']['id']) {
            $model->delete($id);
            $_SESSION['flash'] = "Le trajet a bien été supprimé.";
        }
        header('Location: /');
        exit;
    }

    private function requireLogin(): void {
        if (!isset($_SESSION['user'])) {
            header('Location: /connexion');
            exit;
        }
    }

    /** Contrôles de cohérence sur les données d'un trajet. */
    private function validate(array $d): array {
        $errors = [];
        if (($d['id_agence_depart'] ?? null) === ($d['id_agence_arrivee'] ?? null)) {
            $errors[] = "L'agence de départ et d'arrivée doivent être différentes.";
        }
        if (strtotime($d['gdh_arrivee'] ?? '') <= strtotime($d['gdh_depart'] ?? '')) {
            $errors[] = "La date d'arrivée doit être postérieure à la date de départ.";
        }
        if ((int) ($d['nb_places_total'] ?? 0) < 1) {
            $errors[] = "Le nombre de places doit être supérieur à 0.";
        }
        return $errors;
    }
}