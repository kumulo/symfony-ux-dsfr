<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components\Layout;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent]
class SideMenu
{
    #[ExposeInTemplate]
    public function getMenuId(): ?string
    {
        return 'sidemenu-'.rand();
    }
}
