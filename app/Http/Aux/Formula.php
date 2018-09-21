<?php


namespace App\Http\Aux;


class Formula
{

    /**
     * Compute the ticket count according to provided arguments.
     *
     * @param $rafflePrice    Price of the raffle.
     * @param $gainPercent    Gain percent of the raffle.
     * @param $comPercent     Percent destinated for commissions.
     * @param $ticketPrice    Price of a ticket.
     * @param $transPercent   Percent of a transaction.
     * @return int           Ticket count needed to satisfice the gain in the raffle.
     */
    static function calcTicketCount($rafflePrice, $gainPercent, $comPercent, $ticketPrice, $transPercent)
    {
        return ceil($rafflePrice * (1 + ($gainPercent + $comPercent + $transPercent) / 100) / $ticketPrice);
    }


    /**
     * Compute the ticket price according to provided arguments.
     *
     * @param $rafflePrice    Price of the raffle.
     * @param $gainPercent    Gain percent of the raffle.
     * @param $comPercent     Percent destinated for commissions.
     * @param $ticketCount    Count of tickets.
     * @param $transPercent   Percent of a transaction.
     * @return float|int      Ticket price needed to satisfice the gain in the raffle.
     */
    public static function calcTicketsPrice($rafflePrice, $gainPercent, $comPercent, $ticketCount, $transPercent)
    {
        return round($rafflePrice * (1 + ($gainPercent + $comPercent + $transPercent) / 100) / $ticketCount, 2);
    }
}