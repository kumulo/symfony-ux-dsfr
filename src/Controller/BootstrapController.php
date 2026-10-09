<?php

namespace SymfonyUxDsfr\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/', 'dsfr_bootstrap')]
class BootstrapController extends AbstractController {
    public function __invoke() {
        return $this->render('@UxDsfr/demo/index.html.twig');
    }
}
