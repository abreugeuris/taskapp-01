<?php
/**
 * Created by PhpStorm.
 * User: Geuris
 * Date: 17/07/2018
 * Time: 17:14
 */

namespace AppBundle\Controller\Ticket;


use AppBundle\Entity\Ticket;

use AppBundle\Entity\Usuario;
use AppBundle\Form\TicketType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class TicketController extends Controller
{


    /**
     * @Route("/tickets", name="lista_tickets")
     */
    public function indexTickets()
    {   $tickets = $this->getDoctrine()
        ->getRepository(Ticket::class)
        ->findAll();


        return $this->render('@App/Ticket/lista_ticket.html.twig',
            [
                "tickets"=>$tickets
            ]
        );

    }
    /**
     * @Route("/nuevo/ticket", name="nuevo_ticket")
     */
    public function nuevoTickets()

    {
        $usuarioRepo=$this->getDoctrine()
            ->getRepository(Usuario::class);

            $usuarios = $usuarioRepo
                ->findByTipoUsuario("tecnico");

            $form = $this
                ->CreateForm(TicketType::class);


        return $this->render('@App/Ticket/nuevo_ticket.html.twig',
           ["usuarios"=>$usuarios,
               "form"=>$form->createView()
           ]
        );

    }
    /**
     *
     * @Route("/eliminar/ticket/{id}", name="eliminar_ticket", options={"expose"=true} required=)
     * @Method("DELETE")
     * @param Ticket $ticket
     * @return
     */
    public function indexEliminarTicket(Ticket $ticket)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($ticket);
        $em->flush();

        $jsonContent = $this->get('serializer')->serialize($ticket, 'json');
        $jsonContent = json_decode($jsonContent, true);
        return new JsonResponse($jsonContent);

    }


    // Restful API


    /**
     * @Route("/rest/guardar/ticket", options={"expose"=true}, name="guardar_ticket")
     * @Method("POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function guardarTicket(Request $request)
    {
        $data = $request->getContent();
        $data = json_decode($data, true);

        $ut=$data['usuario_asignado_id'];
        $ticket = new Ticket();
        $usuarioId = new Usuario();
        $usuarioAsignado =new Usuario();

        $ticket->setEstado('pendiente');
        $ticket->setFechaCreado(new \DateTime());
        $ticket->setDescripcion($data["descripcion"]);
        $ticket->setFechaCompletado(null);
        //$ticket->setUsuarioAsignado($data["usuario_asignado_id"]);

        $em = $this->getDoctrine()->getManager();

        $usuarioId = $em -> getRepository(Usuario::class)
            ->find($ut);

        $usuarioAsignado = $em->getRepository(Usuario::class)
            ->find($data['usuario_asignado_id']);

        $ticket->setUsuario($usuarioId);
       $ticket->setUsuarioAsignado($usuarioAsignado);

        $em->persist($ticket);
        $em->flush();

        $jsonContent = $this->get('serializer')->serialize($ticket, 'json');
        $jsonContent = json_decode($jsonContent, true);

        return new JsonResponse($jsonContent);

    }





}