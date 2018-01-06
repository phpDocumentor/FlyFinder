<?php
declare(strict_types=1);

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
 * Class AndSpecification
 */
final class AndSpecification extends CompositeSpecification implements SpecificationInterface
{
    /**
     * @var CompositeSpecification
     */
    private $one;

    /**
     * @var CompositeSpecification
     */
    private $other;

    /**
     * Initializes the AndSpecification object
     *
     * @param CompositeSpecification $one
     * @param CompositeSpecification $other
     */
    public function __construct(CompositeSpecification $one, CompositeSpecification $other)
    {
        $this->one = $one;
        $this->other = $other;
    }

    /**
     * Checks if the value meets the specification
     *
     * @param mixed[] $value
     * @return bool
     */
    public function isSatisfiedBy(array $value) : bool
    {
        return $this->one->isSatisfiedBy($value) && $this->other->isSatisfiedBy($value);
    }
}
