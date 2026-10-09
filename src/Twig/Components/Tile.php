<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent]
class Tile
{
    #[ExposeInTemplate]
    public string $orientation = 'horizontal';

    #[ExposeInTemplate]
    public ?string $href = null;

    #[ExposeInTemplate]
    public ?string $title = null;

    #[ExposeInTemplate]
    public ?string $desc = null;

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined();
        $resolver->setDefaults(['orientation' => 'horizontal']);
        $resolver->setAllowedValues('orientation', ['horizontal', 'vertical']);

        return $resolver->resolve($data) + $data;
    }
}
