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

use Flyfinder\Specification\CompositeSpecification;
use Flyfinder\Specification\SpecificationInterface;
use Generator;
use League\Flysystem\FilesystemOperator;
use RuntimeException;

/**
 * Flysystem plugin to add file finding capabilities to the filesystem entity.
 *
 * Note that found *directories* are **not** returned... only found *files*.
 */
class Finder
{
    /**
     * @var FilesystemOperator|null
     * @psalm-suppress PropertyNotSetInConstructor
     */
    private $filesystem;

    /**
     * Construct the Finder object.
     */
    public function __construct(?FilesystemOperator $filesystem = null)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * Set the Filesystem object.
     */
    public function setFilesystem(FilesystemOperator $filesystem): void
    {
        $this->filesystem = $filesystem;
    }

    /**
     * Find the specified files
     *
     * Note that only found *files* are yielded at this level,
     * which go back to the caller.
     *
     * @see File
     *
     * @return Generator<mixed>
     */
    public function find(SpecificationInterface $specification): Generator
    {
        foreach ($this->yieldFilesInPath($specification, '') as $path) {
            if (!isset($path['type']) || $path['type'] !== 'file') {
                continue;
            }

            yield $path;
        }
    }

    /**
     * Recursively yield files that meet the specification
     *
     * Note that directories are also yielded at this level,
     * since they have to be recursed into.  Yielded directories
     * will not make their way back to the caller, as they are filtered out
     * by {@link find()}.
     *
     * @return Generator<mixed>
     * @psalm-return Generator<array{basename: string, path: string, stream: resource, dirname: string, type: string, extension: string}>
     */
    private function yieldFilesInPath(SpecificationInterface $specification, string $path): Generator
    {
        if (!$this->filesystem) {
            throw new RuntimeException('No filesystem was set in the Finder object');
        }

        $listContents = $this->filesystem->listContents($path);
        /** @psalm-var array{basename: string, path: string, stream: resource, dirname: string, type: string, extension: string} $location */
        foreach ($listContents as $location) {
            if ($specification->isSatisfiedBy($location)) {
                yield $location;
            }

            if (
                $location['type'] !== 'dir'
                || !CompositeSpecification::thatCanBeSatisfiedBySomethingBelow($specification, $location)
            ) {
                continue;
            }

            yield from $this->yieldFilesInPath($specification, $location['path']);
        }
    }
}
