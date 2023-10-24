<?php

namespace App\Twig\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveListener;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentToolsTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
class Pizza
{
    use DefaultActionTrait;
    use ComponentToolsTrait;

    #[LiveProp(writable: true, onUpdated: 'onToppingsUpdated')]
    public array $toppings = [];
    // it is possible to add a premount and use the resolver
    // every live prop is public by deafault to read, not writable

    public function onToppingsUpdated($previousValue): void
    {
        $this->emitToppingsUpdatedEvent($previousValue);
    }

    private function emitToppingsUpdatedEvent($previousValue): void
    {
        $this->emit('Pizza:ToppingsUpdated', [
            'previous' => $previousValue,
            'current' => $this->toppings,
        ]);
    }

    #[LiveAction]
    public function orderPizza(): void
    {
        // Call the action for the PizzaOrderComponent
        $this->emit('AddPizza', [
            'toppings' => $this->toppings,
        ], componentName: 'PizzaOrder');



        // Send the clear event but without sending it to the log
        $this->emitSelf('Pizza:ClearToppings', [
            'log' => false,
        ]);
    }

    #[LiveAction]
    #[LiveListener('Pizza:ClearToppings')]
    public function clearToppings(#[LiveArg] bool $log = true): void
    {
        // IF you execute this action when there are none send a event to the browser
        if ([] === $this->toppings && $log) {
            $this->dispatchBrowserEvent('doh:send');

            return;
        }

        $previousValue = $this->toppings;

        $this->toppings = [];

        if ($log) {
            $this->emitToppingsUpdatedEvent($previousValue);
        }
    }
}