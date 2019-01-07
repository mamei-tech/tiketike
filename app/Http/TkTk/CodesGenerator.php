<?php
/**
 * Created by PhpStorm.
 * User: escape
 * Date: 5/28/18
 * Time: 8:17 PM
 */

namespace App\Http\TkTk;

use App\Raffle;
use App\Ticket;
use Illuminate\Support\Facades\DB;

/**
 * Offers some helper functions for unique keys generation
 *
 * Class CodesGenerator
 * @package App\Http\Aux
 */
class CodesGenerator
{
    /**
     * Aphanumeric symbols for tickets codes generation
     *
     * @var array
     */
    private static $symbols = [
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
        'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
        'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'
    ];

    /**
     * Generate a unsigned long int (64-bit) that not is the key of any raffle.
     *
     * @return float|int
     */
    public static function newRaffleId()
    {
        do
        {
            $id = CodesGenerator::longRand();
        } while (Raffle::find($id) != null);
        return $id;
    }

    /**
     * Generate  a unique ticket code for one raffle.
     *
     * @param Raffle $raffle: Raffle to which the ticket belongs.
     * @param $codeLength: Code length. By default is five.
     * @return string
     */
    // TODO Get codeLength from config.
    public static function newTicketCode(Raffle $raffle, $codeLength = 5)
    {
        do
        {
            $code = CodesGenerator::getRandomCode($codeLength);
        } while (Ticket::where('raffle', $raffle->id)->where('code', $code)->first() != null);
        return $code;
    }

    /**
     * Generate a random unsigned long int.
     *
     * @return float|int
     */
    private static function longRand()
    {
        $max = mt_getrandmax();
        $index = mt_rand(0, $max - 1);
        $offset = mt_rand(0, $max - 1);
        return $index * $max + $offset;
    }

    /**
     * Generate a random code using alphanumeric symbols defined in the array symbols.
     *
     * @param $codeLength: Code length. By default is five.
     * @return string
     */
    private static function getRandomCode($codeLength = 5)
    {
        $n = count(CodesGenerator::$symbols);
        $code = '';
        while ($codeLength-- > 0)
            $code .= CodesGenerator::$symbols[mt_rand(0, $n - 1)];
        return $code;
    }

}