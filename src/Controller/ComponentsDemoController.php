<?php

namespace SymfonyUxDsfr\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/components', 'dsfr_components')]
class ComponentsDemoController extends AbstractController {
    #[Route('/', '')]
    public function __invoke() {
        return $this->render('@UxDsfr/bootstrap/components/index.html.twig');
    }
    #[Route('/GouvLogo', '_GouvLogo')]
    public function GouvLogo() {
        return $this->render('@UxDsfr/bootstrap/components/GouvLogo.html.twig');
    }
    #[Route('/Alert', '_Alert')]
    public function Alert() {
        return $this->render('@UxDsfr/bootstrap/components/Alert.html.twig');
    }
    #[Route('/Button', '_Button')]
    public function Button() {
        return $this->render('@UxDsfr/bootstrap/components/Button.html.twig');
    }
    #[Route('/Callout', '_Callout')]
    public function Callout() {
        return $this->render('@UxDsfr/bootstrap/components/Callout.html.twig');
    }
    #[Route('/Header', '_Header')]
    public function Header() {
        return $this->render('@UxDsfr/bootstrap/components/Header.html.twig');
    }
    #[Route('/Breadcrumb', '_Breadcrumb')]
    public function Breadcrumb() {
        return $this->render('@UxDsfr/bootstrap/components/Breadcrumb.html.twig');
    }
    #[Route('/Highlight', '_Highlight')]
    public function Highlight() {
        return $this->render('@UxDsfr/bootstrap/components/Highlight.html.twig');
    }
    #[Route('/Quote', '_Quote')]
    public function Quote() {
        return $this->render('@UxDsfr/bootstrap/components/Quote.html.twig');
    }
    #[Route('/Summary', '_Summary')]
    public function Summary() {
        return $this->render('@UxDsfr/bootstrap/components/Summary.html.twig');
    }
    #[Route('/Table', '_Table')]
    public function Table() {
        return $this->render('@UxDsfr/bootstrap/components/Table.html.twig');
    }
    #[Route('/Tabs', '_Tabs')]
    public function Tabs() {
        return $this->render('@UxDsfr/bootstrap/components/Tabs.html.twig');
    }
    #[Route('/Tag', '_Tag')]
    public function Tag() {
        return $this->render('@UxDsfr/bootstrap/components/Tag.html.twig');
    }
    #[Route('/Tile', '_Tile')]
    public function Tile() {
        return $this->render('@UxDsfr/bootstrap/components/Tile.html.twig');
    }
}
