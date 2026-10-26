<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent]
class Tag
{
    #[ExposeInTemplate]
    public string $variant = 'default';

    #[ExposeInTemplate]
    public string $size = 'md';

    #[ExposeInTemplate]
    public bool $pressable = false;

    #[ExposeInTemplate]
    public bool $dismissable = false;

    #[ExposeInTemplate]
    public bool $pressed = false;

    #[ExposeInTemplate]
    public ?string $href = null;

    #[ExposeInTemplate]
    public ?string $title = null;

    #[ExposeInTemplate]
    public ?string $target = null;

    #[ExposeInTemplate]
    public string $type = 'button';

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setDefaults([
            'variant' => 'default',
            'size' => 'md',
            'pressable' => false,
            'dismissable' => false,
            'pressed' => false,
            'href' => null,
            'title' => null,
            'target' => null,
            'type' => 'button',
        ]);
        $resolver->setAllowedValues('variant', [
            'default',
            'green-emeraude',
            'green-menthe',
            'blue-cumulus',
            'purple-glycine',
            'pink-macaron',
            'yellow-tournesol',
            'orange-terre-battue',
            'brown-cafe-creme',
            'grey',
        ]);
        $resolver->setAllowedValues('size', ['sm', 'md']);
        $resolver->setAllowedValues('type', ['button', 'submit', 'reset']);
        $resolver->setAllowedTypes('href', ['null', 'string']);
        $resolver->setAllowedTypes('title', ['null', 'string']);
        $resolver->setAllowedTypes('target', ['null', 'string']);
        $resolver->setIgnoreUndefined();

        return $resolver->resolve($data) + $data;
    }
}
