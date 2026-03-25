<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components\Header;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent]
class Service
{
    #[ExposeInTemplate]
    public ?string $link = null;
}