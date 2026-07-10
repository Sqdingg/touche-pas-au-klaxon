<?php
namespace App\Models;
use PDO;

/** Gère l'accès aux données des trajets. */
class TrajetModel {
    public function __construct(private PDO $db) {}

    /** Trajets futurs avec places disponibles, triés par date de départ croissante. */
    public function findAllDisponibles(): array {
        $sql = "SELECT t.*, ad.ville AS ville_depart, aa.ville AS ville_arrivee,
                       e.nom, e.prenom, e.email, e.telephone
                FROM trajet t
                JOIN agence ad ON t.id_agence_depart = ad.id_agence
                JOIN agence aa ON t.id_agence_arrivee = aa.id_agence
                JOIN employe e ON t.id_employe = e.id_employe
                WHERE t.nb_places_disponibles > 0 AND t.gdh_depart >= NOW()
                ORDER BY t.gdh_depart ASC";
        return $this->db->query($sql)->fetchAll();
    }

    public function findAll(): array {
        $sql = "SELECT t.*, ad.ville AS ville_depart, aa.ville AS ville_arrivee
                FROM trajet t
                JOIN agence ad ON t.id_agence_depart = ad.id_agence
                JOIN agence aa ON t.id_agence_arrivee = aa.id_agence
                ORDER BY t.gdh_depart ASC";
        return $this->db->query($sql)->fetchAll();
    }

    public function findById(int $id): array|false {
        $stmt = $this->db->prepare("SELECT * FROM trajet WHERE id_trajet = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create(array $d): bool {
        $sql = "INSERT INTO trajet (id_agence_depart, id_agence_arrivee, gdh_depart, gdh_arrivee, nb_places_total, nb_places_disponibles, id_employe)
                VALUES (:dep, :arr, :gdep, :garr, :total, :dispo, :employe)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'dep' => $d['id_agence_depart'], 'arr' => $d['id_agence_arrivee'],
            'gdep' => $d['gdh_depart'], 'garr' => $d['gdh_arrivee'],
            'total' => $d['nb_places_total'], 'dispo' => $d['nb_places_total'],
            'employe' => $d['id_employe'],
        ]);
    }

    public function update(int $id, array $d): bool {
        $sql = "UPDATE trajet SET id_agence_depart=:dep, id_agence_arrivee=:arr,
                gdh_depart=:gdep, gdh_arrivee=:garr, nb_places_total=:total
                WHERE id_trajet=:id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'dep' => $d['id_agence_depart'], 'arr' => $d['id_agence_arrivee'],
            'gdep' => $d['gdh_depart'], 'garr' => $d['gdh_arrivee'],
            'total' => $d['nb_places_total'], 'id' => $id,
        ]);
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM trajet WHERE id_trajet = :id");
        return $stmt->execute(['id' => $id]);
    }
}