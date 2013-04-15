<?php

namespace Sidus\SidusBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sidus\SidusBundle\Entity\User;
use Sidus\SidusBundle\Form\UserType;
use Sidus\SidusBundle\Entity\Version;

/**
 * User controller.
 *
 */
class UserController extends Controller {

	public function editAction($node, $ascendants, $descendants, $object, Request $request) {
		$form = $this->createForm(new UserType(), $object);
		$em = $this->getDoctrine()->getEntityManager();

		if ($request->isMethod('POST')) {
			$form->bind($request);
			if ($form->isValid()) {
				//@TODO version
				$em->persist($object);
				$em->flush();
				return $this->forward('SidusBundle:User:show', array(
							'node' => $node,
							'ascendants' => $ascendants,
							'descendants' => $descendants,
							'object' => $object,
				));
			}
		}

		return $this->render('SidusBundle:User:edit.html.twig', array(
					'form' => $form->createView(),
					'node' => $node,
					'ascendants' => $ascendants,
					'object' => $object,
		));
	}

	/**
	 * Lists all User entities.
	 *
	 */
	public function indexAction() {
		$em = $this->getDoctrine()->getManager();

		$entities = $em->getRepository('SidusBundle:User')->findAll();

		return $this->render('SidusBundle:User:index.html.twig', array(
					'entities' => $entities,
		));
	}

	/**
	 * Finds and displays a User entity.
	 *
	 */
	public function showAction($loaded_objects) {
		return $this->render('SidusBundle:User:show.html.twig', $loaded_objects);
	}
	
	public function addAction($node, $_locale, $type) {

		$em = $this->getDoctrine()->getEntityManager();
		//@TODO : get connected user
		$user = $em->getRepository('SidusBundle:Node')->find(2);

		$new_object = new User();
		$new_object->setType($type);
		$new_object->setTitle('');
		$em->persist($new_object);
		$em->flush();

		$new_version = new Version();
		$new_version->setNode($node);
		$new_version->setObject($new_object);
		$new_version->setLang($_locale);
		$new_version->setRevision(1);
		$new_version->setRevisionBy($user);
		$em->persist($new_version);

		$em->flush();

		return $this->redirect($this->generateUrl('sidus_edit_node',array(
					'node_id' => $node->getId(),
					'_locale' => $_locale,
		)), 301 );
	}

	/**
	 * Displays a form to create a new User entity.
	 *
	 */
	public function newAction() {
		$entity = new User();
		$form = $this->createForm(new UserType(), $entity);

		return $this->render('SidusBundle:User:new.html.twig', array(
					'entity' => $entity,
					'form' => $form->createView(),
		));
	}

	/**
	 * Creates a new User entity.
	 *
	 */
	public function createAction(Request $request) {
		$entity = new User();
		$form = $this->createForm(new UserType(), $entity);
		$form->bind($request);

		if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($entity);
			$em->flush();

			return $this->redirect($this->generateUrl('user_show', array('id' => $entity->getId())));
		}

		return $this->render('SidusBundle:User:new.html.twig', array(
					'entity' => $entity,
					'form' => $form->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing User entity.
	 *
	 */
//    public function editAction($id)
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('SidusBundle:User')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find User entity.');
//        }
//
//        $editForm = $this->createForm(new UserType(), $entity);
//        $deleteForm = $this->createDeleteForm($id);
//
//        return $this->render('SidusBundle:User:edit.html.twig', array(
//            'entity'      => $entity,
//            'edit_form'   => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }

	/**
	 * Edits an existing User entity.
	 *
	 */
	public function updateAction(Request $request, $id) {
		$em = $this->getDoctrine()->getManager();

		$entity = $em->getRepository('SidusBundle:User')->find($id);

		if (!$entity) {
			throw $this->createNotFoundException('Unable to find User entity.');
		}

		$deleteForm = $this->createDeleteForm($id);
		$editForm = $this->createForm(new UserType(), $entity);
		$editForm->bind($request);

		if ($editForm->isValid()) {
			$em->persist($entity);
			$em->flush();

			return $this->redirect($this->generateUrl('user_edit', array('id' => $id)));
		}

		return $this->render('SidusBundle:User:edit.html.twig', array(
					'entity' => $entity,
					'edit_form' => $editForm->createView(),
					'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a User entity.
	 *
	 */
	public function deleteAction(Request $request, $id) {
		$form = $this->createDeleteForm($id);
		$form->bind($request);

		if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$entity = $em->getRepository('SidusBundle:User')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find User entity.');
			}

			$em->remove($entity);
			$em->flush();
		}

		return $this->redirect($this->generateUrl('user'));
	}

	private function createDeleteForm($id) {
		return $this->createFormBuilder(array('id' => $id))
						->add('id', 'hidden')
						->getForm()
		;
	}

}
