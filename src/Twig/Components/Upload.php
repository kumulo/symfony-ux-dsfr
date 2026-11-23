<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent]
class Upload
{
    private static int $count = 0;

    #[ExposeInTemplate]
    public string $label = '';

    #[ExposeInTemplate]
    public ?string $id = null; // id of the input, unique by default; its messages group is <id>-messages

    #[ExposeInTemplate]
    public ?string $name = null; // the id by default

    #[ExposeInTemplate]
    public ?string $hint = null; // replaces the hint built from maxSize, formats and multiple

    #[ExposeInTemplate]
    public ?string $maxSize = null; // e.g. "20 Mo", first part of the built hint

    #[ExposeInTemplate]
    public array $formats = []; // e.g. ['jpg', 'png', 'pdf'], second part of the built hint

    #[ExposeInTemplate]
    public ?string $accept = null; // the input's accept attribute, e.g. ".jpg,.png,.pdf"

    #[ExposeInTemplate]
    public bool $multiple = false;

    #[ExposeInTemplate]
    public bool $required = false;

    #[ExposeInTemplate]
    public bool $disabled = false;

    #[ExposeInTemplate]
    public ?string $error = null; // error message, fr-upload-group--error

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined(true);
        $resolver->setDefaults([
            'label' => '',
            'id' => null,
            'name' => null,
            'hint' => null,
            'maxSize' => null,
            'formats' => [],
            'accept' => null,
            'multiple' => false,
            'required' => false,
            'disabled' => false,
            'error' => null,
        ]);
        $resolver->setAllowedTypes('label', 'string');
        $resolver->setAllowedTypes('id', ['null', 'string']);
        $resolver->setAllowedTypes('name', ['null', 'string']);
        $resolver->setAllowedTypes('hint', ['null', 'string']);
        $resolver->setAllowedTypes('maxSize', ['null', 'string']);
        $resolver->setAllowedTypes('formats', 'string[]');
        $resolver->setAllowedTypes('accept', ['null', 'string']);
        $resolver->setAllowedTypes('multiple', 'bool');
        $resolver->setAllowedTypes('required', 'bool');
        $resolver->setAllowedTypes('disabled', 'bool');
        $resolver->setAllowedTypes('error', ['null', 'string']);
        $resolver->setNormalizer('id', static fn (Options $options, ?string $id) => $id ?? 'fr-upload-'.++self::$count);
        $resolver->setNormalizer('name', static fn (Options $options, ?string $name) => $name ?? $options['id'].($options['multiple'] ? '[]' : ''));

        return $resolver->resolve($data) + $data;
    }
}
