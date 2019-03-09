<?php
/**
 * This file is a part of "cryptolabs-pk/base58check-php" package.
 * https://github.com/cryptolabs-pk/base58check-php
 *
 * Copyright (c) 2019 Furqan A. Siddiqui <hello@furqansiddiqui.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code or visit following link:
 * https://github.com/cryptolabs-pk/base58check-php/blob/master/LICENSE
 */

declare(strict_types=1);

namespace CryptoLabs\Base58\Result;

use CryptoLabs\DataTypes\Buffer\AbstractStringType;

/**
 * Class Base58Encoded
 * @package CryptoLabs\Base58\Result
 */
class Base58Encoded extends AbstractStringType
{
    /**
     * Base58Encoded constructor.
     * @param string $encoded
     * @param string|null $charset
     */
    public function __construct(string $encoded, ?string $charset = null)
    {
        if (!$encoded) {
            throw new \InvalidArgumentException('Base58Encoded objects cannot be constructed without data');
        }

        if ($charset) {
            if (!preg_match('/^[' . preg_quote($charset, '/') . ']+$/', $encoded)) {
                throw new \InvalidArgumentException('Encoded string does not match given Base58 charset');
            }
        }

        parent::__construct($encoded);
    }
}