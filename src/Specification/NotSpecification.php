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

use League\Flysystem\StorageAttributes;

/**
 * @psalm-immutable
 */
final class NotSpecification extends CompositeSpecification
{
    /** @var SpecificationInterface */
    private $wrapped;

    /**
     * Initializes the NotSpecification object
     */
    public function __construct(SpecificationInterface $wrapped)
    {
        $this->wrapped = $wrapped;
    }

    public function isSatisfiedBy(array|StorageAttributes $value): bool
    {
        return !$this->wrapped->isSatisfiedBy($value);
    }

    public function canBeSatisfiedBySomethingBelow(array|StorageAttributes $value): bool
    {
        return !self::thatWillBeSatisfiedByEverythingBelow($this->wrapped, $value);
    }

    public function willBeSatisfiedByEverythingBelow(array|StorageAttributes $value): bool
    {
        return !self::thatCanBeSatisfiedBySomethingBelow($this->wrapped, $value);
    }
}
