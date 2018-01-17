<?php
declare(strict_types=1);

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

use Flyfinder\Specification\SpecificationInterface;
use Generator;
use League\Flysystem\FilesystemInterface;
use League\Flysystem\PluginInterface;

/**
 * Flysystem plugin to add file finding capabilities to the filesystem entity.
 *
 * Note that found *directories* are **not** returned... only found *files*.
 */
class Finder implements PluginInterface
{
    /** @var FilesystemInterface */
    private $filesystem;

    /**
     * Get the method name.
     */
    public function getMethod(): string
    {
        return 'find';
    }

    /**
     * Set the Filesystem object.
     */
    public function setFilesystem(FilesystemInterface $filesystem): void
    {
        $this->filesystem = $filesystem;
    }

    /**
     * Find the specified files
     *
     * Note that only found *files* are yielded at this level,
     * which go back to the caller.
     */
    public function handle(SpecificationInterface $specification): Generator
    {
        foreach ($this->yieldFilesInPath($specification, '') as $path) {
            if (isset($path['type']) && $path['type'] === 'file') {
                yield $path;
            }
        }
    }

    /**
     * Recursively yield files that meet the specification
     *
     * Note that directories are also yielded at this level,
     * since they have to be recursed into.  Yielded directories
     * will not make their way back to the caller, as they are filtered out
     * by {@link handle()}.
     */
    private function yieldFilesInPath(SpecificationInterface $specification, string $path): Generator
    {
        $listContents = $this->filesystem->listContents($path);
        foreach ($listContents as $location) {
            if ($specification->isSatisfiedBy($location)) {
                yield $location;
            }

            if ($location['type'] === 'dir') {
                foreach ($this->yieldFilesInPath($specification, $location['path']) as $returnedLocation) {
                    yield $returnedLocation;
                }
            }
        }
    }
}
