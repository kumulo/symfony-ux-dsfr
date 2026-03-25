<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components\Layout;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PostMount;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent]
class TwoColumns
{
    public const DEFAULT_POSITION = 'right';
    public string $classColLarge = 'fr-col-12 fr-col-md-8';
    public string $classColSmall = 'fr-col-12 fr-col-md-4';
    #[ExposeInTemplate]
    public string $position = self::DEFAULT_POSITION;
    #[ExposeInTemplate]
    public string $classCol1 = '';
    #[ExposeInTemplate]
    public string $classCol2 = '';

    #[PreMount]
    public function preMount(array $data): array {
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined(true);
        $resolver->setDefaults([
            'position' => self::DEFAULT_POSITION,
        ]);
        $resolver->setAllowedValues('position', ['left', self::DEFAULT_POSITION]);

        return $resolver->resolve($data) + $data;
    }

    #[PostMount]
    public function postMount(): void {
        $this->classCol1 = $this->position === self::DEFAULT_POSITION ? $this->classColSmall : $this->classColLarge;
        $this->classCol2 = $this->position === self::DEFAULT_POSITION ? $this->classColLarge : $this->classColSmall;
    }
}