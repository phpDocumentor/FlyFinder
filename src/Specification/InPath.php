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

namespace Flyfinder\Specification;

use Flyfinder\Path;

/**
 * Class InPath
 *
 * Files *and directories* meet the specification if they are in the given path.
 * Note this behavior is different than in Finder, in that directories *can* meet the spec,
 * whereas Finder would never return a directory as "found".
 */
class InPath extends CompositeSpecification
{
    /**
     * @var Path
     */
    private $path;

    /**
     * Initializes the InPath specification
     */
    public function __construct(Path $path)
    {
        $this->path = $path;
    }

    /**
     * Checks if the value meets the specification
     *
     * @param mixed[] $value
     */
    public function isSatisfiedBy(array $value): bool
    {
        if (in_array($this->path, ['', '.', './'], false)) {
            /*
             * since flysystem stuff is always relative to the filesystem object's root,
             * a spec of "current" dir should always be a match anything being considered
             */
            return true;
        }

        $path = (string) $this->path;
        $validChars = '[a-zA-Z0-9\\\/\.\<\>\,\|\:\(\)\&\;\#]';

        /*
         * a FILE spec would have to match on 'path',
         *   e.g. value path 'src/Cilex/Provider/MonologServiceProvider.php' should match FILE spec of same path...
         * this should also hit a perfect DIR=DIR_SPEC match,
         *   e.g. value path 'src/Cilex/Provider' should match DIR spec of 'src/Cilex/Provider'
         */
        if (isset($value['path'])) {
            $pattern = '(^(?!\/)'
                . str_replace(['?', '*'], [$validChars . '{1}', $validChars . '*'], $path)
                . $validChars . '*)';
            if (preg_match($pattern, $value['path'])) {
                return true;
            }
        }

        /* a DIR spec that wasn't an exact match should be able to match on dirname,
         *   e.g. value dirname 'src' of path 'src/Cilex' should match DIR spec of 'src'
         */
        if (isset($value['dirname'])) {
            $pattern = '(^(?!\/)'
                . str_replace(['?', '*'], [$validChars . '{1}', $validChars . '*'], $path . '/')
                . $validChars . '*)';
            if (preg_match($pattern, $value['dirname'] . '/')) {
                return true;
            }
        }

        return false;
    }
}
