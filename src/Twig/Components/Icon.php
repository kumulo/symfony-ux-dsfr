<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent]
class Icon
{
    #[ExposeInTemplate]
    public ?string $name = null;
    #[PreMount]
    public function preMount(array $data): array
    {
        if (!isset($data['name'])) {
            throw new \InvalidArgumentException('The "name" attribute is required for the Icon component.');
        }

        return $data;
    }
}