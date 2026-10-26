<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent]
class Quote
{
    #[ExposeInTemplate]
    public ?string $author = null;

    #[ExposeInTemplate]
    public array $sources = [];

    #[ExposeInTemplate]
    public ?string $image = null;

    #[ExposeInTemplate]
    public string $image_alt = '';

    #[ExposeInTemplate]
    public string $color = '';

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setDefaults([
            'author' => null,
            'source' => null,
            'sources' => [],
            'image' => null,
            'image_alt' => '',
            'color' => '',
        ]);
        $resolver->setAllowedTypes('author', ['null', 'string']);
        $resolver->setAllowedTypes('sources', 'array');
        $resolver->setAllowedTypes('image', ['null', 'string']);
        $resolver->setAllowedTypes('image_alt', 'string');
        $resolver->setAllowedValues('color', ['', 'green-emeraude', 'green-menthe', 'blue-ecume', 'purple-glycine', 'pink-macaron', 'yellow-tournesol', 'orange-terre-battue', 'brown-cafe-creme', 'grey']);

        return $resolver->resolve($data) + $data;
    }
}
