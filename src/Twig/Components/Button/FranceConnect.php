<?php

namespace SymfonyUxDsfr\Twig\Components\Button;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent]
class FranceConnect
{
    public string $type = 'button';
    public string $provider = 'franceconnect';

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setDefaults([
            'type' => 'button',
            'provider' => 'franceconnect',
        ]);
        $resolver->setIgnoreUndefined();
        $resolver->setAllowedValues('type', ['button', 'submit', 'reset']);
        $resolver->setAllowedValues('provider', ['franceconnect', 'franceconnect_plus', 'proconnect']);

        return $resolver->resolve($data) + $data;
    }

    #[ExposeInTemplate]
    public function getVariation(): string
    {
        return match ($this->provider) {
            'franceconnect' => '',
            'franceconnect_plus' => 'fr-connect--plus',
            'proconnect' => 'fr-connect--pro',
            default => throw new \InvalidArgumentException(sprintf('Invalid provider "%s".', $this->provider)),
        };
    }
}
