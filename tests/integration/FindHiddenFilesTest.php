<?php

declare(strict_types=1);

/**
 * This file is part of phpDocumentor.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @link      http://phpdoc.org
 */

namespace Flyfinder;

use PHPUnit\Framework\TestCase;

use function pathinfo;

use const PATHINFO_BASENAME;

/**
 * Integration test against examples/01-find-hidden-files.php
 *
 * @coversNothing
 */
class FindHiddenFilesTest extends TestCase
{
    public function testFindingHiddenFiles(): void
    {
        $result = [];
        include __DIR__ . '/../../examples/01-find-hidden-files.php';

        $this->assertCount(1, $result);
        $this->assertSame('.test.txt', pathinfo($result[0]['path'], PATHINFO_BASENAME));
    }
}
