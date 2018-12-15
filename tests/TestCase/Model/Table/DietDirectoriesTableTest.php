<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DietDirectoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DietDirectoriesTable Test Case
 */
class DietDirectoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DietDirectoriesTable
     */
    public $DietDirectories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.diet_directories',
        'app.users',
        'app.partners'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('DietDirectories') ? [] : ['className' => DietDirectoriesTable::class];
        $this->DietDirectories = TableRegistry::get('DietDirectories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DietDirectories);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
