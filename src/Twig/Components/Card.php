<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent]
class Card
{
    #[ExposeInTemplate]
    public string $link_type = 'fr-enlarge-link';

    #[ExposeInTemplate]
    public bool $horizontal = false;

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined();
        $defaultType = 'fr-enlarge-link' . (isset($data['horizontal']) ? ' fr-card--download' : '');
        $resolver->setDefaults([
            'link_type' => $defaultType,
        ]);
        return $resolver->resolve($data) + $data;
    }
}