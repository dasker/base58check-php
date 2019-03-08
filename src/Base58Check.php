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

declare(strict_typest=1);

namespace CryptoLabs\Base58;

use CryptoLabs\Base58\Result\Base58Encoded;
use CryptoLabs\BcMath\BcNumber;
use CryptoLabs\DataTypes\Binary;

/**
 * Class Base58Check
 * @package CryptoLabs\Base58
 */
class Base58Check
{
    /**
     * @param Binary $buffer
     * @return Base58Encoded
     */
    public static function Encode(Binary $buffer): Base58Encoded
    {
        $checksum = $buffer->copy();
        $checksum->hash()->digest("sha256", 2, 4); // 2 iterations of SHA256, get 4 bytes from final iteration
        $buffer->append($checksum->raw()); // Append checksum to passed binary data

        $hexits = $buffer->get()->base16();
        $leadingZeros = strlen($hexits) - strlen(ltrim($hexits, "0"));
        $leadingZeros = intval($leadingZeros / 2);

        // Decode buffer from Base16, and pass to BcMath lib for conversion to integrals
        $encoded = Base58::Encode(BcNumber::Decode($hexits));
        return $leadingZeros ? str_repeat("1", $leadingZeros) : $encoded;
    }
}