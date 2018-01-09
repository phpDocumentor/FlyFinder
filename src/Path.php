<?php
declare(strict_types=1);

/**
 * phpDocumentor
 *
 * PHP Version 5.5
 *
 * @copyright 2010-2015 Mike van Riel / Naenius (http://www.naenius.com)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://phpdoc.org
 */

namespace Flyfinder;

/**
 * Value Object for paths.
 * This can be absolute or relative.
 */
final class Path
{
    /**
     * file path
     *
     * @var string
     */
    private $path;

    /**
     * Initializes the path.
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * returns a string representation of the path.
     */
    public function __toString(): string
    {
        return $this->path;
    }
}
