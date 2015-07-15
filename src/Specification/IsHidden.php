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
 * Class IsHidden
 * Files or directories meet the specification if they are hidden
 */
class IsHidden extends CompositeSpecification implements SpecificationInterface
{
    /**
     * Checks if the value meets the specification
     *
     * @param mixed[] $value
     * @return bool
     */
    public function isSatisfiedBy(array $value)
    {
        return isset($value['basename']) && substr($value['basename'], 0, 1) === '.' ? true : false;
    }
}
