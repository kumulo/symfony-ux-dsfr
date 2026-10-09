<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components\Header;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent]
class Brand
{
    #[ExposeInTemplate]
    public ?string $service_link = null;
    #[ExposeInTemplate]
    public ?string $service_logo = null;
    #[ExposeInTemplate]
    public ?string $logo_title = null;
    #[ExposeInTemplate]
    public ?string $service_title = null;
    #[ExposeInTemplate]
    public bool $show_search_button = false;
    #[ExposeInTemplate]
    public string $menu_id = 'header-menu';
    #[ExposeInTemplate]
    public bool $show_menu_button = false;
    #[ExposeInTemplate]
    public string $search_modal_id = 'search-modal';
}
