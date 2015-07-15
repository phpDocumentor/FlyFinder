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
use Flyfinder\Specification\HasExtension;

/**
 * Test case for NotSpecification
 * @coversDefaultClass Flyfinder\Specification\NotSpecification
 */
class NotSpecificationTest extends \PHPUnit_Framework_TestCase
{
    /** @var HasExtension */
    private $hasExtension;

    /** @var NotSpecification */
    private $fixture;

    /**
     * Initializes the fixture for this test.
     */
    public function setUp()
    {
        $this->hasExtension = m::mock('Flyfinder\Specification\HasExtension');
        $this->fixture = new NotSpecification($this->hasExtension);
    }

    /**
     * @covers ::__construct
     * @covers ::isSatisfiedBy
     */
    public function testIfSpecificationIsSatisfied()
    {
        $this->hasExtension->shouldReceive('isSatisfiedBy')->once()->andReturn(false);

        $this->assertTrue($this->fixture->isSatisfiedBy(['test']));
    }

    /**
     * @covers ::__construct
     * @covers ::isSatisfiedBy
     */
    public function testIfSpecificationIsNotSatisfied()
    {
        $this->hasExtension->shouldReceive('isSatisfiedBy')->once()->andReturn(true);

        $this->assertFalse($this->fixture->isSatisfiedBy(['test']));
    }
}
