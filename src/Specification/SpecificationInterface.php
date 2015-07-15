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

/**
 * Interface for FlyFinder specifications
 */
interface SpecificationInterface
{
    /**
     * Checks if the value meets the specification
     *
     * @param mixed[] $value
     * @return bool
     */
    public function isSatisfiedBy(array $value);
}
