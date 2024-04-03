<?php

class Card
{
    private string $suit;
    private string $value;

    public function __construct(string $suit, string $value)
    {
        $this->suit = $suit;
        $this->value = $value;

        $this->validateSuit($this->suit);
        $this->validateValue($this->getValue());
    }

    public function getRank(): string
    {
        return $this->value;
    }
    
    public function getSuit(): string
    {
        $suit = $this->suit;

        $suitSymbol = '';

        switch ($suit) {
            case 'klaveren':
                $suitSymbol = '♣';
                break;
            case 'ruiten':
                $suitSymbol = '◆';
                break;
            case 'schoppen':
                $suitSymbol = '♠';
                break;
            case 'harten':
                $suitSymbol = '♥';
                break;
            default:
                $suitSymbol = 'No symbol found';
                break;
        }
        return $suitSymbol;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    private function validateSuit(): void
    {
        $suit = $this->suit;
        $correctCard = false;

        if ($suit == 'schoppen' || $suit == 'harten' || $suit === 'klaveren' || $suit === 'ruiten') {
            $correctCard = true;
        }

        if ($correctCard === false) {
            throw new InvalidArgumentException('Invalid suit given');
        }
    }

    private function validateValue(string $value): string
    {
        if (is_string($value)) {
            return $value;
        }
        if ($value > 10 || $value == 1) {
            throw new InvalidArgumentException('Invalid value');
        }
        return (string)$value;
    }

    public function show(): string
    {
        $format = $this->getSuit() . ' ' . $this->getValue() . ' ';

        return $format;
    }

    public function score(): int
    {
        $value = $this->getValue();

        if (is_numeric($value)) {
            return intval($value);
        } else {
            return $value == 'Aas' ? 11 : 10;
        }
    }
}