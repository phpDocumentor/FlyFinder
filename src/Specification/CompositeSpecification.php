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
 * Class CompositeSpecification
 * Base class for specifications, allows for combining specifications
 */
abstract class CompositeSpecification
{
    /**
     * @param CompositeSpecification $other
     * @return AndSpecification
     */
    public function andSpecification(CompositeSpecification $other)
    {
        return new AndSpecification($this, $other);
    }

    /**
     * @param CompositeSpecification $other
     * @return OrSpecification
     */
    public function orSpecification(CompositeSpecification $other)
    {
        return new OrSpecification($this, $other);
    }

    /**
     * @return NotSpecification
     */
    public function notSpecification()
    {
        return new NotSpecification($this);
    }
}
