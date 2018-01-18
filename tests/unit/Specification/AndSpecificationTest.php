<?php
/**
 * This file is part of phpDocumentor.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright 2010-2018 Mike van Riel<mike@phpdoc.org>
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://phpdoc.org
 */

namespace Flyfinder\Specification;

use Mockery as m;
use PHPUnit\Framework\TestCase;

/**
 * Test case for AndSpecification
 * @coversDefaultClass Flyfinder\Specification\AndSpecification
 */
class AndSpecificationTest extends TestCase
{
    /** @var m\MockInterface|HasExtension */
    private $hasExtension;

    /** @var m\MockInterface|IsHidden */
    private $isHidden;

    /** @var AndSpecification */
    private $fixture;

    /**
     * Initializes the fixture for this test.
     */
    public function setUp()
    {
        $this->hasExtension = m::mock(HasExtension::class);
        $this->isHidden = m::mock(IsHidden::class);
        $this->fixture = new AndSpecification($this->hasExtension, $this->isHidden);
    }

    public function tearDown()
    {
        m::close();
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
