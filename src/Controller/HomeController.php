<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Stopwatch $stopwatch, CacheInterface $cache)
    {
        $stopwatch->start('calcul-long');

        // On imagine un calcul ou un traitement long
        // $resultatCalcul = $this->fonctionQuiPrendDuTemps();
        $resultatCalcul = $cache->get('resultat-calcul-long', function (ItemInterface $item) {
            // Quand on voudrait que le cache se renouvelle après une minute par exemple
            //$item->expiresAfter(60);

            return $this->fonctionQuiPrendDuTemps();
        });

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
