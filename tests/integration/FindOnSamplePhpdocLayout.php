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

use PHPUnit\Framework\TestCase;

/**
 * Integration test against examples/03-sample-phpdoc-layout.php
 * @coversNothing
 */
class FindOnSamplePhpdocLayout extends TestCase
{
    /**
     * @var string[] $result
     */
    public function testFindingOnSamplePhpdocLayout()
    {
        $result = [];
        include(__DIR__ . '/../../examples/03-sample-phpdoc-layout.php');

        $this->assertEquals(4, count($result));
        $this->assertEquals("JmsSerializerServiceProvider.php", $result[0]['basename']);
        $this->assertEquals("MonologServiceProvider.php", $result[1]['basename']);
        $this->assertEquals("Application.php", $result[2]['basename']);
        $this->assertEquals("Bootstrap.php", $result[3]['basename']);
    }
}
