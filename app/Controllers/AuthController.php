<?php
namespace App\Controllers;
use App\Models\EmployeModel;

class AuthController {
    public function showLogin() {
        require __DIR__ . '/../Views/auth/login.php';
    }

    public function login() {
        $model = new EmployeModel(getPDO());
        $employe = $model->findByEmail($_POST['email'] ?? '');

        if ($employe && password_verify($_POST['mot_de_passe'] ?? '', $employe['mot_de_passe'])) {
            $_SESSION['user'] = [
                'id' => $employe['id_employe'],
                'nom' => $employe['nom'],
                'prenom' => $employe['prenom'],
                'email' => $employe['email'],
                'telephone' => $employe['telephone'],
                'est_admin' => (bool) $employe['est_admin'],
            ];
            header('Location: /');
            exit;
        }

        $erreur = "Identifiant ou mot de passe incorrect.";
        require __DIR__ . '/../Views/auth/login.php';
    }

    public function logout() {
        session_destroy();
        header('Location: /');
        exit;
    }
}