<?php


namespace App\Controller;

use App\Entity\User;
use App\Form\delete;
use App\Form\DeleteFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TableController extends AbstractController
{
    /**
     * @Route("/table", name="app_homepage")
     */

    public function show(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $users = $repository->findAll();

        $form = $this->createForm(DeleteFormType::class, null, [
            'users' => $users
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->getClickedButton() && 'delete' === $form->getClickedButton()->getName()) {

                $entityManager = $this->getDoctrine()->getManager();
                $usersToBeBlocked = $form->get('selectedUsers')->getData();
                foreach ($usersToBeBlocked as $id) {

                    $entityManager->remove($repository->find($id));
                }
                $entityManager->flush();
            }
            elseif ($form->getClickedButton() && 'block' === $form->getClickedButton()->getName()) {
                $entityManager = $this->getDoctrine()->getManager();
                $usersToBeBlocked = $form->get('selectedUsers')->getData();
                foreach ($usersToBeBlocked as $id) {
                    $user =$repository->find($id);
                    $user->setRoles();
                    $user->setIsBlocked(true);
                }
                $entityManager->flush();
            }

            elseif ($form->getClickedButton() && 'unblock' === $form->getClickedButton()->getName()) {
                $entityManager = $this->getDoctrine()->getManager();
                $usersToBeBlocked = $form->get('selectedUsers')->getData();
                foreach ($usersToBeBlocked as $id) {
                    $user =$repository->find($id);
                    $user->setRoles(USER_UNBLOCKED);
                    $user->setIsBlocked(false);
                }
                $entityManager->flush();
            }
        }

        return $this->render('table.html.twig', [
            'users'=> $users,
            'deleteForm' => $form->createView()
        ]);

    }

 //   /**
 //    * @Route("/talbe/{id}}", name="mybundle_apartment")
 //    */
 //   public function delete(Request $request, $id)
 //   {
 //       if (null !== ($request->get('$userId'))) {
//
 //           $entityManager = $this->getDoctrine()->getManager();
 //           $user = $entityManager->getRepository(User::class)->find($id);
//
 //           if (!$user) {
 //               throw $this->createNotFoundException(
 //                   'No user found for id ' . $id
 //               );
 //           }
//
 //           $entityManager->remove($user);
 //           $entityManager->flush();
 //       }
 //   }
}