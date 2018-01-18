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
 * Test case for NotSpecification
 * @coversDefaultClass Flyfinder\Specification\NotSpecification
 */
class NotSpecificationTest extends TestCase
{
    /** @var m\MockInterface|HasExtension */
    private $hasExtension;

    /** @var NotSpecification */
    private $fixture;

    /**
     * Initializes the fixture for this test.
     */
    public function setUp()
    {
        $this->hasExtension = m::mock(HasExtension::class);
        $this->fixture = new NotSpecification($this->hasExtension);
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
