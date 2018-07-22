<?php
/**
 * Created by PhpStorm.
 * User: Geuris
 * Date: 21/07/2018
 * Time: 19:16
 */

namespace AppBundle\Controller\Ticket;


use AppBundle\Entity\Tickets;
use AppBundle\Entity\Usuarios;
use AppBundle\Form\TicketsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TicketController extends Controller

{

    /**
     * @Route("/tickets", name="lista_tickets")
     */
    public function indexTickets()
    {
        $tickets = $this->getDoctrine()
            ->getRepository(Tickets::class)
            ->findAll();


        return $this->render('@App/Ticket/lista_ticket.html.twig',
            [
                "tickets" => $tickets
            ]
        );
    }

    /**
     * @Route("/nuevo/ticket", name="nuevo_ticket")
     */
    public function nuevoTickets()

    {
        $usuarioRepo=$this->getDoctrine()
            ->getRepository(Usuarios::class);

        $usuarios = $usuarioRepo
            ->findByTipoUsuario("tecnico");

        $form = $this
            ->CreateForm(TicketsType::class);


        return $this->render('@App/Ticket/nuevo_ticket.html.twig',
            ["usuarios"=>$usuarios,
                "form"=>$form->createView()
            ]
        );

    }

}