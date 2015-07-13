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
use Flyfinder\Path;

/**
 * Test case for InPath
 * @coversDefaultClass Flyfinder\Specification\InPath
 */
class InPathTest extends \PHPUnit_Framework_TestCase
{
    /** @var InPath */
    private $fixture;

    /**
     * Initializes the fixture for this test.
     */
    public function setUp()
    {
        $this->fixture = new InPath(new Path('/tmp/test'));
    }

    /**
     * @covers ::__construct
     * @covers ::isSatisfiedBy
     * @uses Flyfinder\Path
     */
    public function testIfSpecificationIsSatisfied()
    {
        $this->assertTrue($this->fixture->isSatisfiedBy(['dirname' => '/tmp/test']));
    }

    /**
     * @covers ::__construct
     * @covers ::isSatisfiedBy
     * @uses Flyfinder\Path
     */
    public function testIfSpecificationIsNotSatisfied()
    {
        $this->assertFalse($this->fixture->isSatisfiedBy(['dirname' => '/home']));
    }
}
