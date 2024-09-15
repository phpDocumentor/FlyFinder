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
 * Integration test against examples/03-sample-phpdoc-layout.php
 *
 * @coversNothing
 */
class FindOnSamplePhpdocLayoutTest extends TestCase
{
    public function testFindingOnSamplePhpdocLayout(): void
    {
        $result = [];
        include __DIR__ . '/../../examples/03-sample-phpdoc-layout.php';
        $basenameOf = static fn ($value) => pathinfo($value['path'], PATHINFO_BASENAME);

        $this->assertCount(4, $result);
        $this->assertSame('Bootstrap.php', $basenameOf($result[0]));
        $this->assertSame('Application.php', $basenameOf($result[1]));
        $this->assertSame('JmsSerializerServiceProvider.php', $basenameOf($result[2]));
        $this->assertSame('MonologServiceProvider.php', $basenameOf($result[3]));
    }
}
