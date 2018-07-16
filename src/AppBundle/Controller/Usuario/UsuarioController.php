<?php
/**
 * Created by PhpStorm.
 * User: Geuris
 * Date: 11/06/2018
 * Time: 18:34
 */

namespace AppBundle\Controller\Usuario;


use AppBundle\Entity\Usuario;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UsuarioController extends Controller
{

    /**
     * @Route("/", name="home_taskapp")
     */
    public function indexhome(){
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/usuario", name="lista_usuarios")
     */
    public function indexUsuario()
    {   $usuarios = $this->getDoctrine()
                        ->getRepository(Usuario::class)
                        ->findAll();

        return $this->render('@App/Usuario/lista_usuarios.html.twig',
            [
                "usuarios"=>$usuarios
            ]
        );
    }







    // Restful API


    /**
     *
     * @Route("/rest/usuario", name="guardar_usuario")
     * @Method("POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function guardarUsuario(Request $request)
    {
        $data = $request->getContent();
        $data = json_decode($data, true);

        $usuario = new Usuario();
        $usuario->setNombre($data["nombre"]);
        $usuario->setUsername($data["username"]);
        $usuario->setTipoUsuario($data["tipo_usuario"]);
        $usuario->setContrasena($data["contrasena"]);

        $em = $this->getDoctrine()->getManager();

        $em->persist($usuario);
        $em->flush();

        $jsonContent = $this->get('serializer')->serialize($usuario, 'json');
        $jsonContent = json_decode($jsonContent, true);

        return new JsonResponse($jsonContent);
    }


}