<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function renderAction($name)
    {
        return $this->render('default/prova-twig.html.twig', array(
                'name' => $name
            ));    }

}
