<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Service;

readonly class SearchOptions
{
    public function __construct(
        private ?string $formAction = null,
        private ?string $formMethod = 'get',
        private string $inputName = 'search',
    ) {
    }

    public function getFormAction(): ?string
    {
        return $this->formAction;
    }

    public function getFormMethod(): ?string
    {
        return $this->formMethod;
    }

    public function getInputName(): string
    {
        return $this->inputName;
    }
}
