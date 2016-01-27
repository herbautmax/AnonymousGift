<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Event;
use AppBundle\Entity\Email;
use AppBundle\Form\EventType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
* Event controller.
*
* @Route("/event")
*/
class EventController extends Controller
{

  /**
  * Creates a new Event entity.
  *
  * @Route("/new", name="event_new")
  * @Method({"GET", "POST"})
  */
  public function newAction(Request $request)
  {
    $event = new Event();
    $form = $this->createForm('AppBundle\Form\EventType', $event);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

      $owner = $this->getUser();
      $event->setOwner($owner);

      $em = $this->getDoctrine()->getManager();
      $em->persist($event);
      $em->flush();

      return $this->redirectToRoute('perso');
    }

    return $this->render('event/new.html.twig', array(
      'event' => $event,
      'form' => $form->createView(),
    ));
  }

  /**
  * Finds and displays a Event entity.
  *
  * @Route("/{id}", name="event_show")
  * @Method({"GET", "POST"})
  */
  public function showAction(Event $event, Request $request)
  {
    $email = new Email();
    $form = $this->createFormBuilder($email)
    ->add('email', TextType::class)
    ->add('submit', SubmitType::class, array('label' => 'Add attendee'))
    ->getForm();
    $form->handleRequest($request);

    if ($form->isSubmitted()) {
      $data = $form->getData()->getEmail();
      $user = $usr= $this->get('security.context')->getToken()->getUser()->getUsername();

      $message = \Swift_Message::newInstance()
      ->setSubject('New invitation form '.$user)
      ->setFrom(array('maximehrbt@gmail.com' => 'Anonymous Gift'))
      ->setTo($data)
      ->setBody(
      $this->renderView(
      'event/email.html.twig',
      array('event' => $event)
    ),
    'text/html'
  );
  $this->get('mailer')->send($message);


  $this->get('session')->getFlashBag()->add('info', 'invitation to "' . $data . '" has been sent');
  return $this->redirectToRoute('event_show', array('id' => $event->getId()), 301);
}

return $this->render('event/show.html.twig', array(
  'event' => $event,
  'form' => $form->createView()
));
}

/**
* Displays a form to edit an existing Event entity.
*
* @Route("/{id}/edit", name="event_edit")
* @Method({"GET", "POST"})
*/
public function editAction(Request $request, Event $event)
{
  $editForm = $this->createForm('AppBundle\Form\EventType', $event);
  $editForm->handleRequest($request);

  if ($editForm->isSubmitted() && $editForm->isValid()) {
    $em = $this->getDoctrine()->getManager();
    $em->persist($event);
    $em->flush();

    return $this->redirectToRoute('perso');
  }

  return $this->render('event/edit.html.twig', array(
    'event' => $event,
    'edit_form' => $editForm->createView()
  ));
}
}
