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

namespace Flyfinder\Specification;

use Flyfinder\Path;

/**
 * Class InPath
 * Files and directories meet the specification if they are in the given path
 */
class InPath extends CompositeSpecification implements SpecificationInterface
{
    /**
     * @var Path
     */
    private $path;

    /**
     * Initializes the InPath specification
     *
     * @param Path $path
     */
    public function __construct(Path $path)
    {
        $this->path = $path;
    }

    /**
     * Checks if the value meets the specification
     *
     * @param mixed[] $value
     * @return bool
     */
    public function isSatisfiedBy(array $value)
    {
        if (isset($value['dirname'])) {
            $path = $this->removeDotSlash((string) $this->path);

            if (substr($value['dirname'], 0, strlen($path)) === $path) {
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * If a path is given with a leading ./ this will be removed
     *
     * @param string $dirname
     * @return string
     */
    private function removeDotSlash($dirname)
    {
        if (substr($dirname, 0, 2) === './') {
            $dirname = substr($dirname, 1);
        }
        return $dirname;
    }
}
