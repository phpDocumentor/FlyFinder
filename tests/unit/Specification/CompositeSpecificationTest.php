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
use PHPUnit\Framework\TestCase;

/**
 * Test case for CompositeSpecification
 * @coversDefaultClass Flyfinder\Specification\CompositeSpecification
 */
class CompositeSpecificationTest extends TestCase
{
    /** @var HasExtension */
    private $hasExtension;

    /** @var m::MockObject|CompositeSpecification */
    private $fixture;

    /**
     * Initializes the fixture for this test.
     */
    public function setUp()
    {
        $this->hasExtension = m::mock('Flyfinder\Specification\HasExtension');
        $this->fixture = $this->getMockForAbstractClass('Flyfinder\Specification\CompositeSpecification');
    }

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers ::andSpecification
     * @uses Flyfinder\Specification\AndSpecification
     */
    public function testAndSpecification()
    {
        $this->assertInstanceOf(
            'Flyfinder\Specification\AndSpecification',
            $this->fixture->andSpecification($this->hasExtension)
        );
    }

    /**
     * @covers ::orSpecification
     * @uses Flyfinder\Specification\OrSpecification
     */
    public function testOrSpecification()
    {
        $this->assertInstanceOf(
            'Flyfinder\Specification\OrSpecification',
            $this->fixture->orSpecification($this->hasExtension)
        );
    }

    /**
     * @covers ::notSpecification
     * @uses Flyfinder\Specification\NotSpecification
     */
    public function testNotSpecification()
    {
        $this->assertInstanceOf(
            'Flyfinder\Specification\NotSpecification',
            $this->fixture->notSpecification()
        );
    }
}
