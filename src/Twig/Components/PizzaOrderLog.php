<?php

namespace App\Twig\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveListener;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
class PizzaOrderLog
{
    use DefaultActionTrait;

    #[LiveProp]
    public array $logLines = [];

    #[LiveListener('Pizza:ToppingsUpdated')]
    public function log(#[LiveArg] array $previous, #[LiveArg] array $current): void
    {
        $this->logLines[] = [
            'previous' => $previous,
            'current' => $current,
        ];
    }
}