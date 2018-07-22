<?php
/**
 * Created by PhpStorm.
 * User: Geuris
 * Date: 16/07/2018
 * Time: 21:13
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Usuarios;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use AppBundle\Form\UsuariosType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     * @param Request $request
     * @param AuthenticationUtils $authenticationUtils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(Request $request, AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('@App/Usuario/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/registro", name="register" ,options={"expose"=true})
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {

        $usuario = new Usuarios();
        $form = $this ->createForm(UsuariosType::class,$usuario);
        // Hacemos que el formulario maneje la petición
        $form->handleRequest($request);

        // Comprobamos que se ha enviado el formulario
        if ($form->isSubmitted() && $form->isValid()) {


            // Codificamos la contraseña en texto plano accediendo al 'encoder' que habíamos indicado en la configuración
            $password = $passwordEncoder->encodePassword($usuario, $usuario->getPlainPassword());


            // Establecemos la contraseña real ya codificada al usuario
            $usuario->setContrasena($password);

            //$username = $email
            $usuario->setUsername($usuario->getEmail());

            // Persistimos la entidad como cualquier otra
            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);
            $em->flush();

            // Redigirimos a la pantalla de login para que acceda el nuevo usuario
            //echo "Usuarios guardado";
            return $this->redirectToRoute('login');
        }
        return $this->render(
            '@App/Usuario/registro_usuario.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction(Request $request)
    {
        // UNREACHABLE CODE
    }



}