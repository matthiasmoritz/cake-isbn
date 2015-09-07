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
        $cases = array
        (
            '9783957570000' => array ("978", "3", "95757", "000", "0"),
            '9783789158605' => array ("978", "3", "7891", "5860", "5"),
            '9783789158604' => false,
            '9783832197575' => array ("978", "3", "8321", "9757", "5"),
            '9780747411727' => array ("978", "0", "7474", "1172", "7"),
            '9783829605984' => array ("978", "3", "8296", "0598", "4"),
            '9783000298080' => array ("978", "3", "00", "029808", "0"),
            '9788891506511' => array ("978", "88", "91", "50651", "1")

        );
        foreach ($cases as $isbn => $split)
        {
            $result = $this->IsbnComponent->splitIsbn($isbn);
            $expected = $split;
            $this->assertEquals($expected , $result);
        }
    }
}
