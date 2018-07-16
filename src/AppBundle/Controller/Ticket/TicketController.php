<?php
/**
 * Created by PhpStorm.
 * User: Geuris
 * Date: 17/07/2018
 * Time: 17:14
 */

namespace AppBundle\Controller\Ticket;


use AppBundle\Entity\Ticket;
use FOS\JsRoutingBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TicketController
{






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