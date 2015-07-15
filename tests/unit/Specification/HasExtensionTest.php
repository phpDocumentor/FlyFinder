<?php
/**
 * This file is part of phpDocumentor.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright 2010-2015 Mike van Riel<mike@phpdoc.org>
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://phpdoc.org
 */

namespace Flyfinder\Specification;

use Mockery as m;

/**
 * Test case for HasExtension
 * @coversDefaultClass Flyfinder\Specification\HasExtension
 */
class HasExtensionTest extends \PHPUnit_Framework_TestCase
{
    /** @var HasExtension */
    private $fixture;

    /**
     * Initializes the fixture for this test.
     */
    public function setUp()
    {
        $this->fixture = new HasExtension(['txt']);
    }

    /**
     * @covers ::__construct
     * @covers ::isSatisfiedBy
     */
    public function testIfSpecificationIsSatisfied()
    {
        $this->assertTrue($this->fixture->isSatisfiedBy(['extension' => 'txt']));
    }

    /**
     * @covers ::__construct
     * @covers ::isSatisfiedBy
     */
    public function testIfSpecificationIsNotSatisfied()
    {
        $this->assertFalse($this->fixture->isSatisfiedBy(['extension' => 'php']));
    }
}
