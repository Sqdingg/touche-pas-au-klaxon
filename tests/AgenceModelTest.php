<?php
use PHPUnit\Framework\TestCase;
use App\Models\AgenceModel;

class AgenceModelTest extends TestCase {
    private PDO $pdo;

    protected function setUp(): void {
        require_once __DIR__ . '/../config/database.php';
        $this->pdo = getPDO();
        $this->pdo->beginTransaction();
    }

    protected function tearDown(): void {
        $this->pdo->rollBack();
    }

    public function testCreateAgence(): void {
        $model = new AgenceModel($this->pdo);
        $result = $model->create('Grenoble');
        $this->assertTrue($result);
    }

    public function testUpdateAgence(): void {
        $model = new AgenceModel($this->pdo);
        $model->create('Grenoble');
        $id = (int) $this->pdo->lastInsertId();

        $result = $model->update($id, 'Annecy');
        $this->assertTrue($result);
    }

    public function testDeleteAgence(): void {
        $model = new AgenceModel($this->pdo);
        $model->create('Grenoble');
        $id = (int) $this->pdo->lastInsertId();

        $result = $model->delete($id);
        $this->assertTrue($result);
    }
}