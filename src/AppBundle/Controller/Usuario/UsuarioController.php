<?php
/**
 * Created by PhpStorm.
 * User: Geuris
 * Date: 21/07/2018
 * Time: 19:16
 */

namespace AppBundle\Controller\Usuario;


use AppBundle\Entity\Usuarios;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UsuarioController extends Controller
{

    /**
     * @Route("/", name="home_taskapp", options={"expose"=true})
     */
    public function indexhome(){
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/usuario", name="lista_usuarios")
     */
    public function indexUsuario()
    {   $usuarios = $this->getDoctrine()
        ->getRepository(Usuarios::class)
        ->findAll();

        return $this->render('@App/Usuario/lista_usuarios.html.twig',
            [
                "usuarios"=>$usuarios
            ]
        );

    }

}