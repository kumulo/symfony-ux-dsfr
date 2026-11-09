<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;
use SymfonyUxDsfr\Service\SearchOptions;

#[AsTwigComponent]
class Header
{
    #[ExposeInTemplate]
    public ?string $service_link = null;
    #[ExposeInTemplate]
    public ?string $service_logo = null;
    #[ExposeInTemplate]
    public string $menu_id = 'header-menu';
    #[ExposeInTemplate]
    public bool $show_menu_button = false;
    #[ExposeInTemplate]
    public bool $show_search_button = false;
    #[ExposeInTemplate]
    public array $availables_languages = [];
    #[ExposeInTemplate]
    public string $search_modal_id = 'search-modal';

    #[ExposeInTemplate]
    public ?SearchOptions $search = null;

    public function __construct(SearchOptions $search)
    {
        $this->search = $search;
    }

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined();

        return $resolver->resolve($data) + $data;
    }
}
