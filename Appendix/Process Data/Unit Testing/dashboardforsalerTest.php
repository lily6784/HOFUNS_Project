use PHPUnit\Framework\TestCase;

<?php

class DashboardForSalerTest extends TestCase
{
    private $pdo;

    public function testGetCurrentStock()
    {
        $result = getCurrentStock($this->pdo);
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function testGetSoldRecords()
    {
        $result = getSoldRecords($this->pdo);
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function testGetReturnedRecords()
    {
        $result = getReturnedRecords($this->pdo);
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

   
}
?>