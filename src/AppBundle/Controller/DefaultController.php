<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{

  /**
  * @Route("/", name="home")
  * @Template(":Default:index.html.twig")
  */
  public function indexAction()
  {
    return array(
      'coucou' => 'coucou',
    );
  }

  /**
  * @Route("/perso", name="perso")
  * @Template(":Default:perso.html.twig")
  */
  public function persoAction()
  {

    $em = $this->getDoctrine()->getManager();
    $today = new \DateTime();
    $query = $em->createQuery(
      'SELECT e.name, e.startdate, e.id
      FROM AppBundle:Event e
      LEFT JOIN e.owner o
      WHERE o.id = :user
      AND e.startdate > :today
      ORDER BY e.name ASC'
    )->setParameter('user', $this->getUser()->getId())->setParameter('today', $today);

    $events = $query->getResult();

    return array(
      'events' => $events,
    );
  }



}
