<?php

declare(strict_types=1);

/**
 * This file is part of phpDocumentor.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @link      http://phpdoc.org
 */

namespace Flyfinder\Specification;

/**
 * Class OrSpecification
 *
 * @psalm-immutable
 */
final class OrSpecification extends CompositeSpecification
{
    /** @var SpecificationInterface */
    private $one;

    /** @var SpecificationInterface */
    private $other;

    /**
     * Initializes the OrSpecification object
     */
    public function __construct(SpecificationInterface $one, SpecificationInterface $other)
    {
        $this->one   = $one;
        $this->other = $other;
    }

    /**
     * {@inheritDoc}
     */
    public function isSatisfiedBy(array $value) : bool
    {
        return $this->one->isSatisfiedBy($value) || $this->other->isSatisfiedBy($value);
    }
}
