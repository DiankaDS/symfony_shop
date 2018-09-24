<?php

namespace App\Controller\Auth;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ResetPasswordController extends AbstractController
{
    /**
     * @Route("/profile/reset_password", name="reset_password")
     */
    public function reset_password(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $old_pass = $request->get('old_pass');
        $new_pass = $request->get('new_pass');
        $repeat_new_pass = $request->get('repeat_new_pass');
        $user = $this->getUser();
        $checkPass = $passwordEncoder->isPasswordValid($user, $old_pass);
        if ($checkPass === true && $new_pass === $repeat_new_pass) {

            $encode_pass = $passwordEncoder->encodePassword($user, $new_pass);
            $user->setPassword($encode_pass);

            $date = new \DateTime('@'.strtotime('now'));
            $user->setUpdated($date);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('profile');

        } else {
            return $this->render('auth/reset_password.html.twig');
        }
    }
}
