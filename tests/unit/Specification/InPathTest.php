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

use Flyfinder\Path;
use Mockery as m;
use PHPUnit\Framework\TestCase;

/**
 * Test case for InPath
 * @coversDefaultClass Flyfinder\Specification\InPath
 * @covers ::<private>
 */
class InPathTest extends TestCase
{
    /** @var InPath */
    private $fixture;

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers ::__construct
     * @covers ::isSatisfiedBy
     * @dataProvider validDirnames
     * @uses \Flyfinder\Path
     */
    public function testExactMatch()
    {
        $absolutePath = 'absolute/path/to/file.txt';
        $spec = new InPath(new Path($absolutePath));
        $this->assertTrue($spec->isSatisfiedBy([
            'type' => 'file',
            'path' => $absolutePath,
            'dirname' => $absolutePath,
            'filename' => 'file',
            'extension' => 'txt',
            'basename' => 'file.txt',
        ]));
    }

    private function useWildcardPath()
    {
        $this->fixture = new InPath(new Path('*dden?ir/n'));
    }

    /**
     * @covers ::__construct
     * @covers ::isSatisfiedBy
     * @dataProvider validDirnames
     * @uses \Flyfinder\Path
     */
    public function testIfSpecificationIsSatisfied(string $dirname)
    {
        $this->useWildcardPath();
        $this->assertTrue($this->fixture->isSatisfiedBy(['dirname' => $dirname]));
    }

    /**
     * @covers ::__construct
     * @covers ::isSatisfiedBy
     * @dataProvider validDirnames
     * @uses \Flyfinder\Path
     */
    public function testWithSingleDotSpec(string $dirname)
    {
        $spec = new InPath(new Path('.'));
        $this->assertTrue($spec->isSatisfiedBy(['dirname' => $dirname]));
    }

    /**
     * @covers ::__construct
     * @covers ::isSatisfiedBy
     * @dataProvider validDirnames
     * @uses \Flyfinder\Path
     */
    public function testWithCurrentDirSpec(string $dirname)
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
            ['ddenxir/n'],
        ];
    }

    /**
     * @covers ::__construct
     * @covers ::isSatisfiedBy
     * @dataProvider invalidDirnames
     * @uses \Flyfinder\Path
     */
    public function testIfSpecificationIsNotSatisfied(string $dirname)
    {
        $this->useWildcardPath();
        $this->assertFalse($this->fixture->isSatisfiedBy(['dirname' => $dirname]));
    }

    /**
     * Data provider for testIfSpecificationIsNotSatisfied. Contains a few invalid directory names
     */
    public function invalidDirnames(): array
    {
        return [
            ['/hiddendir/n'],
            ['.hiddendir/normaldir'],
            ['.hiddendir.ext/n'],
            ['.hiddenxxir/n'],
            ['.hiddenir/n'],
        ];
    }
}
