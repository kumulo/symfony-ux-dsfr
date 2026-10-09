<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components\Footer;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent]
class PartnerLink
{
    #[ExposeInTemplate]
    public ?string $title = null;
    #[ExposeInTemplate]
    public string $link;
    #[ExposeInTemplate]
    public string $asset;
}
