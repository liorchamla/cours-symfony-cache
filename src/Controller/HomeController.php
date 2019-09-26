<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Stopwatch\Stopwatch;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Stopwatch $stopwatch)
    {
        $stopwatch->start('calcul-long');

        // On imagine un calcul ou un traitement long
        $resultatCalcul = $this->fonctionQuiPrendDuTemps();

        $stopwatch->stop('calcul-long');

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    private function fonctionQuiPrendDuTemps(): int
    {
        sleep(2);

        return 10;
    }
}
