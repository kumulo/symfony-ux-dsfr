<?php
declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent]
class Dropdown
{
    #[ExposeInTemplate]
    public string $label = 'Menu';

    #[ExposeInTemplate]
    public array $items = []; // [['label'=>'', 'href'=>''] ...]

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setDefaults(['label' => 'Menu', 'items' => []]);
        $resolver->setAllowedTypes('items', 'array');
        return $resolver->resolve($data) + $data;
    }
}