<?php
namespace App\Models;
use PDO;

/** Gère l'accès aux données des employés. */
class EmployeModel {
    public function __construct(private PDO $db) {}

    public function findAll(): array {
        return $this->db->query("SELECT id_employe, nom, prenom, email, telephone, est_admin FROM employe")->fetchAll();
    }

    public function findByEmail(string $email): array|false {
        $stmt = $this->db->prepare("SELECT * FROM employe WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function findById(int $id): array|false {
        $stmt = $this->db->prepare("SELECT * FROM employe WHERE id_employe = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
}