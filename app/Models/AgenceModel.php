<?php
namespace App\Models;
use PDO;

/** Gère l'accès aux données des agences. */
class AgenceModel {
    public function __construct(private PDO $db) {}

    /** @return array Liste de toutes les agences. */
    public function findAll(): array {
        return $this->db->query("SELECT * FROM agence ORDER BY ville ASC")->fetchAll();
    }

    public function create(string $ville): bool {
        $stmt = $this->db->prepare("INSERT INTO agence (ville) VALUES (:ville)");
        return $stmt->execute(['ville' => $ville]);
    }

    public function update(int $id, string $ville): bool {
        $stmt = $this->db->prepare("UPDATE agence SET ville = :ville WHERE id_agence = :id");
        return $stmt->execute(['ville' => $ville, 'id' => $id]);
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM agence WHERE id_agence = :id");
        return $stmt->execute(['id' => $id]);
    }
}