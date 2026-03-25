<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent]
class Tooltip
{
    #[ExposeInTemplate]
    public string $content;

    #[ExposeInTemplate]
    public string $position = 'top';

    #[ExposeInTemplate]
    public array $attributes = [];

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined();
        $resolver->setDefaults([
            'position' => 'top',
            'attributes' => [],
        ]);

        $resolver->setAllowedValues('position', ['top', 'bottom', 'left', 'right']);
        $resolver->setAllowedTypes('attributes', 'array');

        return $resolver->resolve($data) + $data;
    }
}