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
 * Integration test against examples/02-find-on-multiple-criteria.php
 *
 * @coversNothing
 */
class FindOnMultipleCriteriaTest extends TestCase
{
    public function testFindingFilesOnMultipleCriteria(): void
    {
        $result = [];
        include __DIR__ . '/../../examples/02-find-on-multiple-criteria.php';
        $basenameOf = static fn ($value) => pathinfo($value['path'], PATHINFO_BASENAME);

        $this->assertCount(2, $result);
        $this->assertSame('found.txt', $basenameOf($result[0]));
        $this->assertSame('example.txt', $basenameOf($result[1]));
    }
}
