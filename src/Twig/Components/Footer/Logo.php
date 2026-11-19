<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components\Footer;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent]
class Logo
{
    #[ExposeInTemplate]
    public ?string $service_logo = null; // operator logo
    #[ExposeInTemplate]
    public ?string $service_title = null; // operator name, the logo's alt
    #[ExposeInTemplate]
    public ?string $link = '/'; // home page
}
