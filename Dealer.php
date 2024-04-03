<?php

require_once("Player.php");

class Dealer
{
    private $blackjack;
    private $deck;
    private $players;

    public function __construct(Blackjack $blackjack, Deck $deck)
    {
        $this->blackjack = $blackjack;
        $this->deck = $deck;
        $this->players = [];
    }

    public function addPlayer(Player $player)
    {
        $this->players[] = $player;
    }

    public function getBlackjack(): Blackjack
    {
        return $this->blackjack;
    }

    public function playGame()
    {
        $this->playRound(new Player('Dealer', $this->getBlackjack()));

        foreach ($this->players as $player) {
            $this->playRound($player);
        }
    }

    private function playRound(Player $participant)
    {
        $participant->addCard($this->deck->drawCard());
        $participant->addCard($this->deck->drawCard());

        while (true) {
            echo $participant->getName() . ' heeft ';
            foreach ($participant->showHand() as $card) {
                echo $card->show();
            }
            echo PHP_EOL;

            echo "Score: " . $this->getScore($participant) . PHP_EOL;

            $score = $this->getScore($participant);

            if ($score == 'Blackjack' || $score == 'Five Card Charlie') {
                echo "Het spel eindigt voor {$participant->getName()}. {$participant->getName()} heeft $score!" . PHP_EOL;
                break;
            }

            if ($participant instanceof Dealer && $score >= 18) {
                echo "De dealer stopt met spelen." . PHP_EOL;
                break;
            }

            $choice = readline("Nieuwe kaart (n) of stoppen (s)?... ");

            if (strtolower($choice) === 'n') {
                $participant->addCard($this->deck->drawCard());

                if ($this->getScore($participant) === "Busted") {
                    echo "{$participant->getName()} is Busted! {$participant->getName()} heeft verloren." . PHP_EOL;
                    break;
                }
            } elseif (strtolower($choice) === 's') {
                echo "{$participant->getName()} stopt met spelen!" . PHP_EOL;
                break;
            } else {
                echo "Ongeldige keuze. Voer 'n' in om een kaart te trekken of 's' om te stoppen." . PHP_EOL;
            }
        }
    }

    private function getScore(Player $participant)
    {
        return $this->getBlackjack()->calculateScore($participant->showHand());
    }
}
