<?php

/**
 * CRUD controller for approving the image
 *
 * @author Craig R Morton <crmpicco@aol.co.uk>
 * @date   09-Dec-2014
 */

namespace AyrshireMinis\GalleryBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Sonata\AdminBundle\Controller\CRUDController as Controller,
    Symfony\Component\HttpFoundation\RedirectResponse;


class CRUDController extends Controller
{
    /**
     * approve the image by marking it as approved in the DB
     *
     * @return RedirectResponse
     */
    public function approveAction()
    {
        // work out which image we are approving based on the ID in the URL
        $id = $this->get('request')->get($this->admin->getIdParameter());

        $object = $this->admin->getObject($id);

        // couldn't find the object
        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        // set it as approved
        $object->setApproved(1);

        // Get the entity manager and persist the image
        $em = $this->getDoctrine()->getManager();
        $em->persist($object);
        $em->flush();

        // add a flash message at the top to show it's approved
        $this->addFlash('sonata_flash_success', 'Approved!');

        // redirect back to the list view
        return new RedirectResponse($this->admin->generateUrl('list'));
    }

    /**
     * reject the image by deleting it from the DB and removing it from the filesystem
     *
     * @return RedirectResponse
     */
    public function rejectAction()
    {
        // work out which image we are approving based on the ID in the URL
        $id = $this->get('request')->get($this->admin->getIdParameter());

        $object = $this->admin->getObject($id);

        // couldn't find the object
        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        // Get the entity manager and remove the image from the DB
        $em = $this->getDoctrine()->getManager();
        $em->remove($object);
        $em->flush();

        // physically delete the image from the filesystem
        unlink(__DIR__ . '/../../../../web/images/gallery/' . $id . '.jpeg');

        // add a flash message at the top to show it's rejected
        $this->addFlash('sonata_flash_success', 'Rejected!');

        // redirect back to the list view
        return new RedirectResponse($this->admin->generateUrl('list'));

    }

    /**
     * preview the image
     *
     * @return RedirectResponse
     */
    public function viewImageAction()
    {
        // work out which image we are approving based on the ID in the URL
        $id = $this->get('request')->get($this->admin->getIdParameter());

        $object = $this->admin->getObject($id);

        // couldn't find the object
        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        return $this->render('AyrshireMinisGalleryBundle::empty_layout.html.twig', array('image' => $object));

    }
}