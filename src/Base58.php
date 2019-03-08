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

namespace CryptoLabs\Base58;

use CryptoLabs\Base58\Result\Base58Encoded;
use CryptoLabs\BcMath\BcNumber;

/**
 * Class Base58
 * @package CryptoLabs\Base58
 */
class Base58
{
    private const CHARSET = "123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz";

    /**
     * @param BcNumber $number
     * @return Base58Encoded
     */
    public static function Encode(BcNumber $number): Base58Encoded
    {
        $charset = self::CHARSET;
        $num = $number->value();
        $encoded = "";

        while (true) {
            if (bccomp($num, "58") === -1) {
                break;
            }

            $div = bcdiv($num, "58");
            $mod = bcmod($num, "58");
            $char = $charset{intval($mod)};
            $encoded = $char . $encoded;
            $num = $div;
        }

        $nums[] = $num;

        if ($num >= 0) {
            $encoded = $charset{intval($num)} . $encoded;
        }

        return new Base58Encoded($encoded);
    }
}