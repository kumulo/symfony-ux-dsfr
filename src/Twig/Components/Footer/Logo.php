<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components\Footer;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent]
class Logo
{
    #[ExposeInTemplate]
    public ?string $service_logo = null;
    #[ExposeInTemplate]
    public ?string $link = null;
}
