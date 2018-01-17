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

namespace Flyfinder;

use PHPUnit\Framework\TestCase;

/**
 * Integration test against examples/01-find-hidden-files.php
 * @coversNothing
 */
class FindHiddenFilesTest extends TestCase
{
    public function testFindingHiddenFiles()
    {
        $result = [];
        include(__DIR__ . '/../../examples/01-find-hidden-files.php');

        $this->assertCount(1, $result);
        $this->assertSame('.test.txt', $result[0]['basename']);
    }
}
