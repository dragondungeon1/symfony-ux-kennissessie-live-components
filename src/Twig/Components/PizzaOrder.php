<?php


namespace App\Twig\Components;


use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveListener;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;


#[AsLiveComponent]
class PizzaOrder
{
    use DefaultActionTrait;

    public int $count = 0;

    #[LiveProp(writable: true)]
    public array $orderLines = [];

    #[LiveListener('AddPizza')]
    public function addPizza(#[LiveArg] array $toppings = []): void
    {
        $this->count++;

        $this->orderLines[] = [
            'price' => 8 + count($toppings),
            'toppings' => $toppings
        ];
    }

    public function getTotal(): float
    {
        return array_sum(array_map(static fn($orderLine) => $orderLine['price'], $this->orderLines));
    }
}