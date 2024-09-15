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

use function in_array;
use function preg_match;

/**
 * Files and directories meet the specification if they have the given extension
 *
 * @psalm-immutable
 */
class HasExtension extends CompositeSpecification
{
    /** @var string[] */
    private $extensions;

    /**
     * Receives the file extensions you want to find
     *
     * @param string[] $extensions
     */
    public function __construct(array $extensions)
    {
        $this->extensions = $extensions;
    }

    public function isSatisfiedBy(array|StorageAttributes $value): bool
    {
        $matches = [];
        /** @psalm-suppress ImpureMethodCall */
        if (preg_match('/(^|\/)\.[^.]+$/', (string) $value['path'])) {
            return false;
        }

        /** @psalm-suppress ImpureMethodCall */
        preg_match('/\.([^.]+)$/', (string) $value['path'], $matches);
        $extension = $matches[1] ?? null;

        return $extension !== null && in_array($extension, $this->extensions, false);
    }
}
