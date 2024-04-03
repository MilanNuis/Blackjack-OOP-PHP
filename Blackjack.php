<?php

require_once('Card.php');

class Blackjack
{
    private $blackjack;

    // Deze functie moet checken of je Blackjack hebt.
    public function getBlackjack(): Blackjack
    {
        return $this->blackjack;
    }

    // Dit rekent je score uit. Die hij dus weer gebruikt bij je blackjack
    public function calculateScore(array $hand): string
    {
        $score = 0;
        $numAces = 0;

        foreach ($hand as $card) {
            $score += $card->score();
            if ($card->getRank() === 'A') {
                $numAces++;
            }
        }

        while ($score <= 11 && $numAces > 0) {
            $score += 10;
            $numAces--;
        }

        if ($score > 21) {
            return 'Busted';
        } elseif ($score == 21 && count($hand) == 2) {
            return 'Blackjack';
        } elseif (count($hand) == 5 && $score <= 21) {
            return 'Five Card Charlie';
        }

        return strval($score);
    }
}
