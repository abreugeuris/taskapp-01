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
    public function nuevoTickets(Request $request)

    {
        $usuarioRepo=$this->getDoctrine()->getRepository(Usuario::class);
            $usuarios = $usuarioRepo->findByTipoUsuario("tecnico");

        return $this->render('@App/Ticket/nuevo_ticket.html.twig',
           ["usuarios"=>$usuarios]
        );

    }



    // Restful API


    /**
     * @Route("/rest/usuario", options={"expose"=true}, name="guardar_usuario")
     * @Method("POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function guardarUsuario(Request $request)
    {
        $data = $request->getContent();
        $data = json_decode($data, true);

        $ticket = new Ticket();
        $ticket->setFechaCreado($data["fecha_creado"]);
        $ticket->setDescripcion($data["descripcion"]);
        $ticket->setFechaCompletado($data["fecha_completado"]);



        $em = $this->getDoctrine()->getManager();

        $em->persist($ticket);
        $em->flush();

        $jsonContent = $this->get('serializer')->serialize($ticket, 'json');
        $jsonContent = json_decode($jsonContent, true);

        return new JsonResponse($jsonContent);
    }

}