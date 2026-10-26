<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent]
class Table
{
    #[ExposeInTemplate]
    public bool $bordered = false;

    #[ExposeInTemplate]
    public bool $scrollable = false;

    #[ExposeInTemplate]
    public bool $stickyHeader = false;

    #[ExposeInTemplate]
    public string $caption = '';

    #[ExposeInTemplate]
    public string $id = '';

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setDefaults([
            'bordered' => false,
            'scrollable' => false,
            'stickyHeader' => false,
            'caption' => '',
            'id' => '',
        ]);
        $resolver->setAllowedTypes('caption', 'string');
        $resolver->setAllowedTypes('id', 'string');
        $resolver->setIgnoreUndefined();

        return $resolver->resolve($data) + $data;
    }
}
