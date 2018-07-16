<?php
/**
 * Created by PhpStorm.
 * User: Geuris
 * Date: 16/06/2018
 * Time: 15:34
 */

namespace AppBundle\Controller\Usuario;


use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioType;
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
    /**
     * @Route("/registro", name="registro_usuario")
     */
    public function indexRegistro( Request $request){

        $usuario=new Usuario();
        $form= $this->createForm(UsuarioType::class,$usuario);
        $form->handleRequest($request);

        return $this->render(
            '@App/Usuario/registro_usuario.html.twig',
            array('form' => $form->createView())
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