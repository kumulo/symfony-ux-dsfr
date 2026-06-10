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

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setDefaults(['variant' => 'default']);
        $resolver->setAllowedValues('variant', ['default', 'success', 'error', 'info', 'warning']);
        return $resolver->resolve($data) + $data;
    }
}
