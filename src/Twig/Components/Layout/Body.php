<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components\Layout;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent]
class Body
{
	#[ExposeInTemplate]
	public string $id = 'content';

	#[ExposeInTemplate]
	public string $role = 'main';

	#[PreMount]
	public function preMount(array $data): array
	{
		$resolver = new OptionsResolver();
		$resolver->setIgnoreUndefined(true);
		$resolver->setDefaults([
			'id' => 'content',
			'role' => 'main',
		]);

		return $resolver->resolve($data) + $data;
	}
}
