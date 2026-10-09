<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent]
class Input
{
    #[ExposeInTemplate]
    public string $name = '';

    #[ExposeInTemplate]
    public ?string $id = null;

    #[ExposeInTemplate]
    public string $type = 'text';

    #[ExposeInTemplate]
    public ?string $value = null;

    #[ExposeInTemplate]
    public ?string $label = null;

    #[ExposeInTemplate]
    public ?string $placeholder = null;

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined(true);
        $resolver->setDefaults([
            'name' => '',
            'id' => null,
            'type' => 'text',
            'value' => null,
            'label' => null,
            'placeholder' => null,
        ]);
        $resolver->setAllowedValues('type', ['text', 'email', 'password', 'search', 'tel', 'url', 'number']);

        // ensure id default
        if (!isset($data['id']) || null === $data['id']) {
            $data['id'] = '' !== $data['name'] ? $data['name'] : 'input-'.rand();
        }

        return $resolver->resolve($data) + $data;
    }
}
