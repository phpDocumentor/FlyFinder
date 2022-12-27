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

namespace Flyfinder\Specification;

use League\Flysystem\StorageAttributes;

use function pathinfo;
use function str_starts_with;

use const PATHINFO_BASENAME;

/**
 * Files or directories meet the specification if they are hidden
 *
 * @psalm-immutable
 */
class IsHidden extends CompositeSpecification
{
    public function isSatisfiedBy(array|StorageAttributes $value): bool
    {
        /** @psalm-suppress ImpureMethodCall */
        $basename = pathinfo((string) $value['path'], PATHINFO_BASENAME);

        return $basename && str_starts_with($basename, '.');
    }
}
