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

    #[PreMount]
    public function preMount(array $data): array {
        $resolver = new OptionsResolver();
        $resolver->setDefaults([
            'type' => 'info',
        ]);

        $resolver->setAllowedValues('type', ['info', 'warning', 'error', 'success']);

        return $resolver->resolve($data) + $data;
    }
}