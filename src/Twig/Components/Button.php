<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent]
class Button
{
    #[ExposeInTemplate]
    public string $variant = 'primary';

    #[ExposeInTemplate]
    public ?string $href = null;

    #[ExposeInTemplate]
    public ?string $type = 'button';

    #[ExposeInTemplate]
    public bool $disabled = false;

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setDefaults([
            'variant' => 'primary',
            'type' => 'button',
            'disabled' => false,
        ]);
        $resolver->setIgnoreUndefined();
        $resolver->setAllowedValues('variant', ['primary', 'secondary', 'tertiary', 'tertiary-no-outline']);
        $resolver->setAllowedValues('type', ['button', 'submit', 'reset']);
        return $resolver->resolve($data) + $data;
    }
}
