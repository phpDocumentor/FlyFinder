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
            $path = $this->cleanPath((string) $this->path);
            $validChars = '[a-zA-Z0-9\\\/\.\<\>\,\|\:\(\)\&\;\#]';

            $pattern = '(^(?!\/)'
                . str_replace(['?', '*'], [$validChars . '{1}', $validChars . '*'], $path)
                . $validChars . '*)';

            if (preg_match($pattern, $value['dirname'] . '/')) {
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * If a path is given with a leading ./ this will be removed
     * If a path doesn't have a trailing /, a slash will be added
     *
     * @param string $path
     * @return string
     */
    private function cleanPath($path)
    {
        if ($path === '.' || $path === './') {
            return '';
        }

        if (substr($path, 0, 2) === './') {
            $path = substr($path, 1);
        }

        if (substr($path, -1) !== '/') {
            $path = $path . '/';
        }

        return $path;
    }
}
