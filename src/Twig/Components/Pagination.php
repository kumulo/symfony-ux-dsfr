<?php
declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent]
class Pagination
{
    #[ExposeInTemplate]
    public int $current = 1;

    #[ExposeInTemplate]
    public int $total = 1;

    #[ExposeInTemplate]
    public string $path = '#page=%d';

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setDefaults([
            'current' => 1,
            'total' => 1,
            'path' => '#page=%d',
        ]);
        $resolver->setAllowedTypes('current', 'int');
        $resolver->setAllowedTypes('total', 'int');

        return $resolver->resolve($data) + $data;
    }

    public function pages(): array
    {
        $pages = [];
        for ($i = 1; $i <= max(1, $this->total); $i++) {
            $pages[] = [
                'number' => $i,
                'href' => sprintf($this->path, $i),
                'current' => $i === $this->current,
            ];
        }
        return $pages;
    }
}