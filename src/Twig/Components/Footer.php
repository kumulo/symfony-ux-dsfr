<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\Twig\Components;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent]
class Footer
{
    #[ExposeInTemplate]
    public ?string $service_link = null;
    #[ExposeInTemplate]
    public ?string $service_logo = null;
    #[ExposeInTemplate]
    public ?string $logo_title = null;
    #[ExposeInTemplate]
    public ?string $service_title = null;
    #[ExposeInTemplate]
    public ?array $partners = null;

    #[PreMount]
    public function postMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined();
        $resolver->setDefaults(['partners' => []]);
        $resolver->setAllowedTypes('partners', ['null', 'array']);

        if (isset($data['partners']['main'])) {
            $data['partners']['main'] = $this->resolvePartner($data['partners']['main']);
        }

        if (isset($data['partners']['subs'])) {
            foreach ($data['partners']['subs'] as $key => $partner) {
                $data['partners']['subs'][$key] = $this->resolvePartner($partner);
            }
        }

        return $resolver->resolve($data) + $data;
    }

    private function resolvePartner(array $data): array
    {
        $partnerResolver = new OptionsResolver();
        $partnerResolver->setIgnoreUndefined();
        $partnerResolver->setDefaults([
            'link' => '',
            'title' => '',
            'asset' => '',
        ]);
        $partnerResolver->setAllowedTypes('link', 'string');
        $partnerResolver->setAllowedTypes('title', 'string');
        $partnerResolver->setAllowedTypes('asset', 'string');

        return $partnerResolver->resolve($data) + $data;
    }
}
