<?php

namespace SymfonyUxDsfr\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/components', 'dsfr_components')]
class ComponentsDemoController extends AbstractController {
    #[Route('/', '')]
    public function __invoke() {
        return $this->render('@UxDsfr/demo/components/index.html.twig');
    }
    #[Route('/Accordion', '_Accordion')]
    public function Accordion() {
        return $this->render('@UxDsfr/demo/components/Accordion.html.twig');
    }
    #[Route('/Badge', '_Badge')]
    public function Badge() {
        return $this->render('@UxDsfr/demo/components/Badge.html.twig');
    }
    #[Route('/GouvLogo', '_GouvLogo')]
    public function GouvLogo() {
        return $this->render('@UxDsfr/demo/components/GouvLogo.html.twig');
    }
    #[Route('/Alert', '_Alert')]
    public function Alert() {
        return $this->render('@UxDsfr/demo/components/Alert.html.twig');
    }
    #[Route('/Button', '_Button')]
    public function Button() {
        return $this->render('@UxDsfr/demo/components/Button.html.twig');
    }
    #[Route('/Callout', '_Callout')]
    public function Callout() {
        return $this->render('@UxDsfr/demo/components/Callout.html.twig');
    }
    #[Route('/Card', '_Card')]
    public function Card() {
        return $this->render('@UxDsfr/demo/components/Card.html.twig');
    }
    #[Route('/Footer', '_Footer')]
    public function Footer() {
        return $this->render('@UxDsfr/demo/components/Footer.html.twig');
    }
    #[Route('/Header', '_Header')]
    public function Header() {
        return $this->render('@UxDsfr/demo/components/Header.html.twig');
    }
    #[Route('/Breadcrumb', '_Breadcrumb')]
    public function Breadcrumb() {
        return $this->render('@UxDsfr/demo/components/Breadcrumb.html.twig');
    }
    #[Route('/Highlight', '_Highlight')]
    public function Highlight() {
        return $this->render('@UxDsfr/demo/components/Highlight.html.twig');
    }
    #[Route('/Icon', '_Icon')]
    public function Icon() {
        return $this->render('@UxDsfr/demo/components/Icon.html.twig');
    }
    #[Route('/Quote', '_Quote')]
    public function Quote() {
        return $this->render('@UxDsfr/demo/components/Quote.html.twig');
    }
    #[Route('/Summary', '_Summary')]
    public function Summary() {
        return $this->render('@UxDsfr/demo/components/Summary.html.twig');
    }
    #[Route('/Table', '_Table')]
    public function Table() {
        return $this->render('@UxDsfr/demo/components/Table.html.twig');
    }
    #[Route('/Tabs', '_Tabs')]
    public function Tabs() {
        return $this->render('@UxDsfr/demo/components/Tabs.html.twig');
    }
    #[Route('/ThemeSwitcher', '_ThemeSwitcher')]
    public function ThemeSwitcher() {
        return $this->render('@UxDsfr/demo/components/ThemeSwitcher.html.twig');
    }
    #[Route('/LayoutBody', '_LayoutBody')]
    public function LayoutBody() {
        return $this->render('@UxDsfr/demo/components/LayoutBody.html.twig');
    }
    #[Route('/Tag', '_Tag')]
    public function Tag() {
        return $this->render('@UxDsfr/demo/components/Tag.html.twig');
    }
    #[Route('/Tile', '_Tile')]
    public function Tile() {
        return $this->render('@UxDsfr/demo/components/Tile.html.twig');
    }
}
