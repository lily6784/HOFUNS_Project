<?php
use PHPUnit\Framework\TestCase;


class DashboardForAdminTest extends TestCase
{
    private $pdo;

    protected function setUp(): void
    {
        $this->pdo = $this->createMock(PDO::class);
    }

    public function testGetAllUsers()
    {
        $stmt = $this->createMock(PDOStatement::class);
        $stmt->method('fetchAll')->willReturn([
            ['id' => 1, 'name' => 'John Doe', 'username' => 'johndoe', 'role' => 'admin', 'status_inactive' => false]
        ]);

        $this->pdo->method('query')->willReturn($stmt);

        $result = getAllUsers($this->pdo);
        $this->assertCount(1, $result);
        $this->assertEquals('John Doe', $result[0]['name']);
    }

    public function testGetActiveUsers()
    {
        $stmt = $this->createMock(PDOStatement::class);
        $stmt->method('fetchAll')->willReturn([
            ['id' => 1, 'name' => 'John Doe', 'username' => 'johndoe', 'role' => 'admin', 'status_inactive' => false]
        ]);

        $this->pdo->method('prepare')->willReturn($stmt);
        $stmt->method('execute')->willReturn(true);

        $result = getActiveUsers($this->pdo);
        $this->assertCount(1, $result);
        $this->assertEquals('John Doe', $result[0]['name']);
    }

    public function testGetInactiveUsers()
    {
        $stmt = $this->createMock(PDOStatement::class);
        $stmt->method('fetchAll')->willReturn([
            ['id' => 2, 'name' => 'Jane Doe', 'username' => 'janedoe', 'role' => 'saler', 'status_inactive' => true]
        ]);

        $this->pdo->method('prepare')->willReturn($stmt);
        $stmt->method('execute')->willReturn(true);

        $result = getInactiveUsers($this->pdo);
        $this->assertCount(1, $result);
        $this->assertEquals('Jane Doe', $result[0]['name']);
    }

    public function testGetAllStock()
    {
        $stmt = $this->createMock(PDOStatement::class);
        $stmt->method('fetchAll')->willReturn([
            ['item_name' => 'Item1', 'total_quantity' => 10, 'total_scrapped' => 1, 'total_sold' => 2, 'total_returned' => 1, 'onshelf' => 6]
        ]);

        $this->pdo->method('query')->willReturn($stmt);

        $result = getAllStock($this->pdo);
        $this->assertCount(1, $result);
        $this->assertEquals('Item1', $result[0]['item_name']);
    }
}
