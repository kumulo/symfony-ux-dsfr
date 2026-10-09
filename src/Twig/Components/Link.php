<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent]
class Link
{
    public string $class = 'fr-link';
    public string $link = '#';
    public ?string $id = null;
    public ?string $target = '_self';
    public ?string $rel = '';
    public ?string $title = '';
    public ?bool $jsNavigationLink = false;

    #[PreMount]
    public function preMount(array $data): array
    {
        // validate data
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined(true);

        $resolver->setDefaults([
            'link' => '#',
            'jsNavigationLink' => false,
            'target' => '_self',
        ]);
        $resolver->setAllowedValues('target', ['_self', '_blank']);

        $return = $resolver->resolve($data) + $data;

        if ('_blank' === $return['target']) {
            $return['rel'] = 'noopener external';
            $return['title'] = isset($return['title']) ? $return['title'].' - nouvelle fenêtre' : 'nouvelle fenêtre';
        }

        return $return;
    }
}
