<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;

/**
 * DSFR pagination: first, previous, the first and last pages, the current page and its neighbours, next, last.
 * Pages away from the current one only show from the lg breakpoint, as in the DSFR example.
 */
#[AsTwigComponent]
class Pagination
{
    #[ExposeInTemplate]
    public int $current = 1;

    #[ExposeInTemplate]
    public int $total = 1;

    /** Link of a page, "%d" standing for its number */
    #[ExposeInTemplate]
    public string $path = '#page=%d';

    /** Link of the first page, when it differs from the path's: a list's URL without its page parameter */
    #[ExposeInTemplate]
    public ?string $firstPath = null;

    /** How many pages around the current one */
    #[ExposeInTemplate]
    public int $neighbours = 1;

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined();
        $resolver->setDefaults([
            'current' => 1,
            'total' => 1,
            'path' => '#page=%d',
            'firstPath' => null,
            'neighbours' => 1,
        ]);
        $resolver->setAllowedTypes('current', 'int');
        $resolver->setAllowedTypes('total', 'int');
        $resolver->setAllowedTypes('path', 'string');
        $resolver->setAllowedTypes('firstPath', ['null', 'string']);
        $resolver->setAllowedTypes('neighbours', 'int');

        return $resolver->resolve($data) + $data;
    }

    public function last(): int
    {
        return max(1, $this->total);
    }

    /** "%d" replaced, not sprintf: a URL can hold other "%" (encoded characters) */
    public function href(int $page): string
    {
        if (1 === $page && null !== $this->firstPath) {
            return $this->firstPath;
        }

        return str_replace('%d', (string) $page, $this->path);
    }

    /**
     * First, previous, next or last: no href on the first or last page, where the DSFR disables it.
     *
     * @param list<'first'|'prev'|'next'|'last'> $names
     *
     * @return array<string, array{href: string|null, class: string}>
     */
    public function edges(array $names): array
    {
        $current = min(max(1, $this->current), $this->last());
        $edges = [
            'first' => [$current > 1 ? 1 : null, 'fr-pagination__link--first'],
            'prev' => [$current > 1 ? $current - 1 : null, 'fr-pagination__link--lg-label fr-pagination__link--prev'],
            'next' => [$current < $this->last() ? $current + 1 : null, 'fr-pagination__link--lg-label fr-pagination__link--next'],
            'last' => [$current < $this->last() ? $this->last() : null, 'fr-pagination__link--last'],
        ];

        $result = [];
        foreach ($names as $name) {
            [$page, $class] = $edges[$name];
            $result[$name] = ['href' => null === $page ? null : $this->href($page), 'class' => $class];
        }

        return $result;
    }

    /**
     * The page links and the gaps between them.
     *
     * @return list<array{number: int|null, href: string|null, current: bool, near: bool}> number null for a gap
     */
    public function pages(): array
    {
        $current = min(max(1, $this->current), $this->last());
        $numbers = array_unique([1, ...range(max(1, $current - $this->neighbours), min($this->last(), $current + $this->neighbours)), $this->last()]);
        sort($numbers);

        $pages = [];
        $previous = 0;
        foreach ($numbers as $number) {
            if ($number - $previous > 1) {
                $pages[] = ['number' => null, 'href' => null, 'current' => false, 'near' => false];
            }
            $pages[] = [
                'number' => $number,
                'href' => $this->href($number),
                'current' => $number === $current,
                'near' => abs($number - $current) <= 1,
            ];
            $previous = $number;
        }

        return $pages;
    }
}
