<?php

class Deck
{
    private $cards = array();

    public function __construct()
    {
        $this->generateCard();
    }

    private function generateCard()
    {
        $suits = ['klaveren', 'schoppen', 'ruiten', 'harten'];
        $values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'Jacks', 'Queen', 'Kings', 'Aas'];

        foreach ($suits as $suit) {
            foreach ($values as $value) {
                $card = new Card($suit, $value);
                $this->cards[] = $card;
            }
        }
    }

    public function drawCard(): Card
    {
        if (empty($this->cards)) {
            throw new Exception('Deck is leeg, ik kan je geen nieuwe kaart geven.');
        }

        $randomIndex = array_rand($this->cards);
        $drawnCard = $this->cards[$randomIndex];

        array_splice($this->cards, $randomIndex, 1);

        return $drawnCard;
    }
}
