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
use Flyfinder\Specification\IsHidden;

/**
 * Test case for AndSpecification
 * @coversDefaultClass Flyfinder\Specification\AndSpecification
 */
class AndSpecificationTest extends \PHPUnit_Framework_TestCase
{
    /** @var HasExtension */
    private $hasExtension;

    /** @var IsHidden */
    private $isHidden;

    /** @var AndSpecification */
    private $fixture;

    /**
     * Initializes the fixture for this test.
     */
    public function setUp()
    {
        $this->hasExtension = m::mock('Flyfinder\Specification\HasExtension');
        $this->isHidden = m::mock('Flyfinder\Specification\IsHidden');
        $this->fixture = new AndSpecification($this->hasExtension, $this->isHidden);
    }

    /**
     * @covers ::__construct
     * @covers ::isSatisfiedBy
     */
    public function testIfSpecificationIsSatisfied()
    {
        $this->hasExtension->shouldReceive('isSatisfiedBy')->once()->andReturn(true);
        $this->isHidden->shouldReceive('isSatisfiedBy')->once()->andReturn(true);

        $this->assertTrue($this->fixture->isSatisfiedBy(['test']));
    }

    /**
     * @covers ::__construct
     * @covers ::isSatisfiedBy
     */
    public function testIfSpecificationIsNotSatisfied()
    {
        $this->hasExtension->shouldReceive('isSatisfiedBy')->once()->andReturn(true);
        $this->isHidden->shouldReceive('isSatisfiedBy')->once()->andReturn(false);

        $this->assertFalse($this->fixture->isSatisfiedBy(['test']));
    }
}
