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
 * Class NotSpecification
 */
final class NotSpecification extends CompositeSpecification implements SpecificationInterface
{
    /**
     * @var CompositeSpecification
     */
    private $wrapped;

    /**
     * Initializes the NotSpecification object
     *
     * @param CompositeSpecification $wrapped
     */
    public function __construct(CompositeSpecification $wrapped)
    {
        $this->wrapped = $wrapped;
    }

    /**
     * Checks if the value meets the specification
     *
     * @param mixed[] $value
     * @return bool
     */
    public function isSatisfiedBy(array $value)
    {
        return ! $this->wrapped->isSatisfiedBy($value);
    }
}
