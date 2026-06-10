<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent]
class Quote
{
    #[ExposeInTemplate]
    public ?string $author = null;

    #[ExposeInTemplate]
    public ?string $source = null;
}
