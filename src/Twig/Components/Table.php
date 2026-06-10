<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent]
class Table
{
    #[ExposeInTemplate]
    public bool $bordered = false;

    #[ExposeInTemplate]
    public bool $noScroll = false;

    #[ExposeInTemplate]
    public bool $noCaption = false;
}
