<?php

namespace SymfonyUxDsfr\Twig\Components\Nav;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent]
class Item
{
    #[ExposeInTemplate]
    public ?string $href = null;
}