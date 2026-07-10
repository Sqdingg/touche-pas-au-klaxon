<?php
use PHPUnit\Framework\TestCase;
use App\Models\TrajetModel;

class TrajetModelTest extends TestCase {
    private PDO $pdo;

    protected function setUp(): void {
        require_once __DIR__ . '/../config/database.php';
        $this->pdo = getPDO();
        $this->pdo->beginTransaction();
    }

    protected function tearDown(): void {
        $this->pdo->rollBack();
    }

    public function testCreateTrajet(): void {
        $model = new TrajetModel($this->pdo);
        $result = $model->create([
            'id_agence_depart' => 1,
            'id_agence_arrivee' => 2,
            'gdh_depart' => '2026-08-01 08:00:00',
            'gdh_arrivee' => '2026-08-01 10:00:00',
            'nb_places_total' => 3,
            'id_employe' => 1,
        ]);
        $this->assertTrue($result);
    }

    public function testUpdateTrajet(): void {
        $model = new TrajetModel($this->pdo);
        $model->create([
            'id_agence_depart' => 1, 'id_agence_arrivee' => 2,
            'gdh_depart' => '2026-08-01 08:00:00', 'gdh_arrivee' => '2026-08-01 10:00:00',
            'nb_places_total' => 3, 'id_employe' => 1,
        ]);
        $id = (int) $this->pdo->lastInsertId();

        $result = $model->update($id, [
            'id_agence_depart' => 1, 'id_agence_arrivee' => 3,
            'gdh_depart' => '2026-08-02 09:00:00', 'gdh_arrivee' => '2026-08-02 11:00:00',
            'nb_places_total' => 4,
        ]);
        $this->assertTrue($result);
    }

    public function testDeleteTrajet(): void {
        $model = new TrajetModel($this->pdo);
        $model->create([
            'id_agence_depart' => 1, 'id_agence_arrivee' => 2,
            'gdh_depart' => '2026-08-01 08:00:00', 'gdh_arrivee' => '2026-08-01 10:00:00',
            'nb_places_total' => 3, 'id_employe' => 1,
        ]);
        $id = (int) $this->pdo->lastInsertId();

        $result = $model->delete($id);
        $this->assertTrue($result);
    }
}