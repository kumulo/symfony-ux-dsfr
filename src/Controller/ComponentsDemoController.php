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
}