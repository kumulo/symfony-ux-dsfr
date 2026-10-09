<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent]
class Accordion
{
    public ?string $accordionId = null;
    public bool $expanded = false;

    #[PreMount]
    public function preMount(array $data): array
    {
        if (!isset($data['accordionId']) || null === $data['accordionId']) {
            $data['accordionId'] = 'accordion-'.rand();
        }

        return $data;
    }
}
