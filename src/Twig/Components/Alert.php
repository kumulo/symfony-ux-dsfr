<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent]
class Alert
{
    #[ExposeInTemplate]
    public string $type = 'info';

    #[ExposeInTemplate]
    public bool $closable = false;

    #[ExposeInTemplate]
    public string $size = 'md';

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined();

        $resolver->setDefaults([
            'type' => 'info',
            'closable' => false,
            'size' => 'md',
        ]);

        $resolver->setAllowedValues('type', ['info', 'warning', 'error', 'success']);
        $resolver->setAllowedValues('size', ['sm', 'md']);

        return $resolver->resolve($data) + $data;
    }
}
