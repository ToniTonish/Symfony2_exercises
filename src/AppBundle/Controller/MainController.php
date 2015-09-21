<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Gruppo;
use AppBundle\Entity\Utenti;
use AppBundle\DQL\RandFunction;

/**
 * Gruppo controller.
 *
 * @Route("/")
 */
class MainController extends Controller
{
    /**
     * Lists welcome name.
     *
     * @Route("/prova-twig/{name}", name="welcome")
     * @Method("GET")
     * @Template("AppBundle:Main:prova-twig.html.twig")
     */
    public function renderAction($name)
    {
        return array(
                'name' => $name
            );    
    }

    /**
     * Create 3 users and one group.
     *
     * @Route("/crea-utenti", name="crea_utenti")
     * @Method("GET")
     * @Template("AppBundle:Main:crea-utenti.html.twig")
     */
    public function createUsersAndGroupAction()
    {
        $gruppo = new Gruppo();
        $gruppo->setNome('Developer');

        $utente_1 = new Utenti();
        $utente_1->setNome('foo');
        $utente_1->setCognome('lorem');
        $utente_1->setEmail('lorem@hotmail.it');
        // relate user to the group
        $utente_1->setGruppo($gruppo);

        $utente_2 = new Utenti();
        $utente_2->setNome('foo2');
        $utente_2->setCognome('lorem2');
        $utente_2->setEmail('lorem2@hotmail.it');
        // relate user to the group
        $utente_2->setGruppo($gruppo);

        $utente_3 = new Utenti();
        $utente_3->setNome('foo3');
        $utente_3->setCognome('lorem3');
        $utente_3->setEmail('lorem3@hotmail.it');
        // relate user to the group
        $utente_3->setGruppo($gruppo);


        $em = $this->getDoctrine()->getManager();
        $em->persist($gruppo);
        $em->persist($utente_1);
        $em->persist($utente_2);
        $em->persist($utente_3);
        $em->flush();

    	return array(
            'return' => "ok"
            );
    }

    /**
     * Show random users and group.
     *
     * @Route("/prova-doctrine", name="prova-doctrine")
     * @Method("GET")
     * @Template("AppBundle:Main:prova-doctrine.html.twig")
     */
    public function showUsersAndGroup()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("SELECT RAND() as HIDDEN rand, u.id, u.nome, u.cognome, u.email, g.nome as gruppo FROM AppBundle:Utenti u JOIN AppBundle:Gruppo g WHERE u.gruppo = g.id ORDER BY rand");
        $users = $query->getResult();
        //shuffle($users);
        return array(
            'users' => $users,
            );
    }

}
