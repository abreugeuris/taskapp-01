<?php
/**
 * Created by PhpStorm.
 * User: Geuris
 * Date: 16/07/2018
 * Time: 21:13
 */

namespace AppBundle\Controller\Tarea;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TareaController extends Controller
{


    /**
     *
     * @Route("/tarea", name="lista_tareas")
     */
    public function indexTareas()
    {
        return $this->render('@App/Tarea/lista_tareas.html.twig');
    }



}