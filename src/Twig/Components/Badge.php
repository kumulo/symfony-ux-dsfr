<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent]
class Badge
{
    #[ExposeInTemplate]
    public string $type = 'info';

    #[ExposeInTemplate]
    public string $size = 'md';

    #[ExposeInTemplate]
    public bool $ellipsis = false;

    #[ExposeInTemplate]
    public string $content;

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined();
        $resolver->setDefaults([
            'type' => 'info',
            'size' => 'md',
            'ellipsis' => false,
        ]);

        $resolver->setAllowedValues('type', ['info', 'warning', 'error', 'success']);
        $resolver->setAllowedValues('size', ['sm', 'md', 'lg']);

        return $resolver->resolve($data) + $data;
    }
}
