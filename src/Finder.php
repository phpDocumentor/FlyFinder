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

use Generator;
use League\Flysystem\FilesystemInterface;
use League\Flysystem\PluginInterface;
use Flyfinder\Specification\SpecificationInterface;

/**
 * Flysystem plugin to add file finding capabilities to the filesystem entity
 */
class Finder implements PluginInterface
{
    /** @var FilesystemInterface */
    private $filesystem;

    /**
     * Get the method name.
     *
     * @return string
     */
    public function getMethod()
    {
        return 'find';
    }

    /**
     * Set the Filesystem object.
     *
     * @param FilesystemInterface $filesystem
     * @return void
     */
    public function setFilesystem(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * Find the specified files
     *
     * @param SpecificationInterface $specification
     * @return Generator
     */
    public function handle(SpecificationInterface $specification)
    {
        foreach ($this->yieldFilesInPath($specification, '') as $path) {
            yield $path;
        }
    }

    /**
     * Recursively yield files that meet the specification
     *
     * @param SpecificationInterface $specification
     * @param string $path
     * @return Generator
     */
    private function yieldFilesInPath(SpecificationInterface $specification, $path)
    {
        $listContents = $this->filesystem->listContents($path);
        foreach ($listContents as $location) {
            if ($specification->isSatisfiedBy($location)) {
                yield $location;
            }
            if ($location['type'] == 'dir') {
                foreach ($this->yieldFilesInPath($specification, $location['path']) as $returnedLocation) {
                    yield $returnedLocation;
                }
            }
        }
    }
}
