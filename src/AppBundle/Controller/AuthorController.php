<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Author;


class AuthorController extends FOSRestController
{
    
	/**
     * @Rest\Get("/author")
     */
    public function readAction()
    {
      $restresult = $this->getDoctrine()->getRepository('AppBundle:Author')->findAll();
        if ($restresult === null) {
          return new View("there are no author exist", Response::HTTP_NOT_FOUND);
        }
		    $view = $this->view($restresult, Response::HTTP_OK);
        return $view;
    }
	
	
	/**
     * @Rest\Get("/author/{id}")
     */
    public function readoneAction($id)
    {
      $singleresult = $this->getDoctrine()->getRepository('AppBundle:Author')->find($id);
       if ($singleresult === null) {
        return new View("author not found", Response::HTTP_NOT_FOUND);
       }
       $view = $this->view($singleresult, Response::HTTP_OK);
       return $view;
    }
	
	
	/**
	 * @Rest\Post("/author")
	 */
	public function postAction(Request $request)
	{
	  $data = new Author;
	  $name = $request->get('name');
	  
		if(empty($name))
		{
		  return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE); 
		} 
	 $data->setName($name);
	 
	 $em = $this->getDoctrine()->getManager();
	 $em->persist($data);
	 $em->flush();
	 
   $view = $this->view("Author Added Successfully", Response::HTTP_OK);
   return $view;
	}
	
	
	
}
