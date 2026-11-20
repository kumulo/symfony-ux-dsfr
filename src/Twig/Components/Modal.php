<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent]
class Modal
{
    #[ExposeInTemplate]
    public string $id; // controlled by the opening button's aria-controls

    #[ExposeInTemplate]
    public ?string $title = null; // or the title block; labels the modal

    #[ExposeInTemplate]
    public string $size = 'md';

    #[ExposeInTemplate]
    public bool $top = false; // action zone at the top on mobile

    #[ExposeInTemplate]
    public bool $concealingBackdrop = true; // false: a click on the backdrop does not close the modal

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined();
        $resolver->setRequired('id');
        $resolver->setDefaults([
            'title' => null,
            'size' => 'md',
            'top' => false,
            'concealingBackdrop' => true,
        ]);
        $resolver->setAllowedTypes('id', 'string');
        $resolver->setAllowedTypes('title', ['null', 'string']);
        $resolver->setAllowedValues('size', ['sm', 'md', 'lg']);

        return $resolver->resolve($data) + $data;
    }

    #[ExposeInTemplate]
    public function getColumnClasses(): string
    {
        return match ($this->size) {
            'sm' => 'fr-col-12 fr-col-md-6 fr-col-lg-4',
            'lg' => 'fr-col-12 fr-col-md-10 fr-col-lg-8',
            default => 'fr-col-12 fr-col-md-8 fr-col-lg-6',
        };
    }
}
