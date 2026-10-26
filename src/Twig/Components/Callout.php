<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent]
class Callout
{
    #[ExposeInTemplate]
    public string $color = '';

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setDefaults(['color' => '']);
        $resolver->setAllowedValues('color', ['', 'green-emeraude', 'green-menthe', 'blue-ecume', 'purple-glycine', 'pink-macaron', 'yellow-tournesol', 'orange-terre-battue', 'brown-cafe-creme', 'grey']);

        return $resolver->resolve($data) + $data;
    }
}
