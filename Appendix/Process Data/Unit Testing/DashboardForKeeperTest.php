use PHPUnit\Framework\TestCase;

class DashboardForKeeperTest extends TestCase
{
    private $pdo;

    protected function setUp(): void
    {
        $host = 'your_host';
        $dbname = 'your_dbname';
        $user = 'your_user';
        $password = 'your_password';

        $this->pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function testGetCurrentStock()
    {
        $result = getCurrentStock($this->pdo);
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertArrayHasKey('item_name', $result[0]);
        $this->assertArrayHasKey('onshelf', $result[0]);
        $this->assertArrayHasKey('total_scrapped', $result[0]);
    }

    public function testGetScrappedRecords()
    {
        $result = getScrappedRecords($this->pdo);
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertArrayHasKey('item_name', $result[0]);
        $this->assertArrayHasKey('total_scrapped', $result[0]);
        $this->assertArrayHasKey('total_quantity', $result[0]);
    }

    public function testAddStock()
    {
        $_POST['add_stock'] = true;
        $_POST['item_name'] = 'Test Item';
        $_POST['quantity'] = 5;

        ob_start();
        include '/Users/kaguya/MasterOfComputing/8500SoftwareEngineering/Group_Project/HOFUNS_Project/htdocs_final_edition/dashboardforkeeper.php';
        $output = ob_get_clean();

        $this->assertStringContainsString('items sucessfully added！', $output);

        $stmt = $this->pdo->query('SELECT COUNT(*) FROM "8500_HKMU_G13"."INVENTORY" WHERE item_name = \'Test Item\'');
        $count = $stmt->fetchColumn();
        $this->assertEquals(5, $count);
    }

    public function testAddScrap()
    {
        $_POST['scrapped_quantity'] = true;
        $_POST['scrapped_item_name'] = 'Test Item';
        $_POST['scrapped_quantity'] = 2;

        ob_start();
        include '/Users/kaguya/MasterOfComputing/8500SoftwareEngineering/Group_Project/HOFUNS_Project/htdocs_final_edition/dashboardforkeeper.php';
        $output = ob_get_clean();

        $this->assertStringContainsString('Scraped！', $output);

        $stmt = $this->pdo->query('SELECT COUNT(*) FROM "8500_HKMU_G13"."INVENTORY" WHERE item_name = \'Test Item\' AND status_scrapped = TRUE');
        $count = $stmt->fetchColumn();
        $this->assertEquals(2, $count);
    }
}
?>