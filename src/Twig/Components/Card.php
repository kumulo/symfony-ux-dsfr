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
    public ?string $href = null;
    #[ExposeInTemplate]
    public ?string $card_header = null;
    #[ExposeInTemplate]
    public string $card_header_alt = '';
    #[ExposeInTemplate]
    public string $link_type = 'fr-enlarge-link';

    #[ExposeInTemplate]
    public bool $horizontal = false;
    #[ExposeInTemplate]
    public ?string $file_size = null;
    #[ExposeInTemplate]
    public ?string $file_type = null;

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined();
        $defaultType = 'fr-enlarge-link'.(isset($data['horizontal']) ? ' fr-card--download' : '');
        $resolver->setDefaults([
            'link_type' => $defaultType,
        ]);

        return $resolver->resolve($data) + $data;
    }
}
