<?php
declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent]
class Breadcrumb
{
    #[ExposeInTemplate]
    public array $items = []; // each item: ['label' => '...', 'href' => null]

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined(true);
        $resolver->setDefaults(['items' => [], 'aria-label' => 'Vous êtes ici :']);
        $resolver->setAllowedTypes('items', 'array');
        $resolver->setAllowedTypes('aria-label', 'string');

        return $resolver->resolve($data) + $data;
    }
}