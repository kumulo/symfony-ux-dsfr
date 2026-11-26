<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;

/**
 * A DSFR Chart web component (@gouvfr/dsfr-chart) with its data as a table in an accordion, the accessible
 * alternative the DSFR asks for. Other attributes (selected-palette, unit-tooltip, stacked, …) go to the chart.
 */
#[AsTwigComponent]
class Chart
{
    public const TYPES = ['bar', 'line', 'pie'];

    #[ExposeInTemplate]
    public string $type = 'bar';

    /** @var array<string|int|float> x axis values, or the slices of a pie */
    #[ExposeInTemplate]
    public array $labels = [];

    /** @var array<string|int, array<int|float>> values by series name, one value per label */
    #[ExposeInTemplate]
    public array $series = [];

    #[ExposeInTemplate]
    public string $caption = ''; // the data table's caption

    #[ExposeInTemplate]
    public string $labelsHeader = ''; // the data table's header of the labels column

    #[ExposeInTemplate]
    public bool $table = true;

    #[ExposeInTemplate]
    public string $chartId = '';

    /**
     * @param array<string, mixed> $data
     *
     * @return array<string, mixed>
     */
    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined(true);
        $resolver->setDefaults(['type' => 'bar', 'labels' => [], 'series' => [], 'caption' => '', 'labelsHeader' => '', 'table' => true, 'chartId' => '']);
        $resolver->setAllowedValues('type', self::TYPES);
        $resolver->setAllowedTypes('labels', 'array');
        $resolver->setAllowedTypes('series', 'array');
        $resolver->setAllowedTypes('caption', 'string');
        $resolver->setAllowedTypes('labelsHeader', 'string');
        $resolver->setAllowedTypes('table', 'bool');
        $resolver->setAllowedTypes('chartId', 'string');
        $resolver->setNormalizer('chartId', static fn ($options, string $id): string => '' !== $id ? $id : 'chart-'.random_int(0, PHP_INT_MAX));

        return $resolver->resolve($data) + $data;
    }

    /** The chart's x attribute: the labels, as one list */
    public function getX(): string
    {
        return $this->json([array_values($this->labels)]);
    }

    /** The chart's y attribute: one list of values per series */
    public function getY(): string
    {
        return $this->json(array_map(array_values(...), array_values($this->series)));
    }

    /** The chart's name attribute: the series names, or the slice names of a pie */
    public function getName(): string
    {
        $names = 'pie' === $this->type ? $this->labels : array_keys($this->series);

        return $this->json(array_map(strval(...), array_values($names)));
    }

    /** @param array<mixed> $value */
    private function json(array $value): string
    {
        return json_encode($value, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
