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
 * Class HasExtension
 * Files and directories meet the specification if they have the given extension
 */
class HasExtension extends CompositeSpecification
{
    /**
     * @var string[]
     */
    private $extensions;

    /**
     * Receives the file extensions you want to find
     *
     * @param string[] $extensions
     */
    public function __construct(array $extensions)
    {
        $this->extensions = $extensions;
    }

    /**
     * Checks if the value meets the specification
     *
     * @param mixed[] $value
     */
    public function isSatisfiedBy(array $value): bool
    {
        return isset($value['extension']) && in_array($value['extension'], $this->extensions, false) ? true : false;
    }
}
