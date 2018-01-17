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

/**
 * Class NotSpecification
 */
final class NotSpecification extends CompositeSpecification
{
    /**
     * @var SpecificationInterface
     */
    private $wrapped;

    /**
     * Initializes the NotSpecification object
     */
    public function __construct(SpecificationInterface $wrapped)
    {
        $this->wrapped = $wrapped;
    }

    /**
     * Checks if the value meets the specification
     *
     * @param mixed[] $value
     */
    public function isSatisfiedBy(array $value): bool
    {
        return !$this->wrapped->isSatisfiedBy($value);
    }
}
