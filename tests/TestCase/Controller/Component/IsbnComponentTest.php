<?php
namespace Isbn\Test\TestCase\Controller\Component;

use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;
use Isbn\Controller\Component\IsbnComponent;

/**
 * Isbn\Controller\Component\IsbnComponent Test Case
 */
class IsbnComponentTest extends TestCase
{

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->IsbnComponent = new IsbnComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->IsbnComponent);

        parent::tearDown();
    }

    /**
     * Test splitIsbn method
     *
     * @return void
     */
    public function testSplitIsbn()
    {
        $result = $this->IsbnComponent->splitIsbn('9783957570000');
        $expected = array ("978", "3", "95757","000","0");
        $this->assertEquals($expected , $result);
        
        $result = $this->IsbnComponent->splitIsbn('9783789158605');
        $expected = array ("978", "3", "7891","5860","5");
        $this->assertEquals($expected , $result);
        
    }
}
