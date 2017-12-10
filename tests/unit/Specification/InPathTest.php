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
        $this->fixture = new InPath(new Path('*dden?ir/n'));
    }

    /**
     * @covers ::__construct
     * @covers ::isSatisfiedBy
     * @covers ::<private>
     * @dataProvider validDirnames
     * @uses Flyfinder\Path
     */
    public function testIfSpecificationIsSatisfied($dirname)
    {
        $this->assertTrue($this->fixture->isSatisfiedBy(['dirname' => $dirname]));
    }

    /**
     * @covers ::__construct
     * @covers ::isSatisfiedBy
     * @covers ::<private>
     * @dataProvider validDirnames
     * @uses Flyfinder\Path
     */
    public function testWithSingleDotSpec($dirname)
    {
        $spec = new InPath(new Path('.'));
        $this->assertTrue($spec->isSatisfiedBy(['dirname' => $dirname]));
    }

    /**
     * @covers ::__construct
     * @covers ::isSatisfiedBy
     * @covers ::<private>
     * @dataProvider validDirnames
     * @uses Flyfinder\Path
     */
    public function testWithCurrentDirSpec($dirname)
    {
        $spec = new InPath(new Path('./'));
        $this->assertTrue($spec->isSatisfiedBy(['dirname' => $dirname]));
    }

    /**
     * Data provider for testIfSpecificationIsSatisfied. Contains a few valid directory names
     *
     * @return array
     */
    public function validDirnames()
    {
        return [
            ['.hiddendir/n'],
            ['.hiddendir/n/'],
            ['.hiddendir/n/somedir'],
            ['.hiddendir/n/somedir.txt'],
            ['ddenxir/n']
        ];
    }

    /**
     * @covers ::__construct
     * @covers ::isSatisfiedBy
     * @covers ::<private>
     * @dataProvider invalidDirnames
     * @uses Flyfinder\Path
     */
    public function testIfSpecificationIsNotSatisfied($dirname)
    {
        $this->assertFalse($this->fixture->isSatisfiedBy(['dirname' => $dirname]));
    }

    /**
     * Data provider for testIfSpecificationIsNotSatisfied. Contains a few invalid directory names
     *
     * @return array
     */
    public function invalidDirnames()
    {
        return [
            ['/hiddendir/n'],
            ['.hiddendir/normaldir'],
            ['.hiddendir.ext/n'],
            ['.hiddenxxir/n'],
            ['.hiddenir/n']
        ];
    }
}
