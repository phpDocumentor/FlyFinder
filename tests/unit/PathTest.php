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

namespace Flyfinder;

/**
 * Test case for Path
 * @coversDefaultClass Flyfinder\Path
 */
class PathTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::__construct
     * @covers ::__toString
     */
    public function testToString()
    {
        $path = new Path('/my/Path');

        $this->assertEquals('/my/Path', (string)$path);
    }
}
