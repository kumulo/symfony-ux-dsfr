<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components\Accordion;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent]
class Group
{
    #[ExposeInTemplate]
    public string $group = 'true';
    #[PreMount]
    public function preMount(array $data): array {
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined(true);
        $resolver->setDefaults([
            'group' => 'true',
        ]);

        $resolver->setAllowedValues('group', ['true', 'false']);

        return $resolver->resolve($data) + $data;
    }
}