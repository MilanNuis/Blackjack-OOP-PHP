<?php

class Player
{
    private $name;
    private $hand = array();
    private $blackjack;

    public function __construct($name, Blackjack $blackjack)
    {
        $this->name = $name;
        $this->blackjack = $blackjack;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function addCard(Card $card)
    {
        $this->hand[] = $card;
    }

    public function showHand(): array
    {
        return $this->hand;
    }

    public function getScore(): string
    {
        return $this->blackjack->calculateScore($this->showHand());
    }
}
