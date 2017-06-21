<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Article;


class ArticleController extends FOSRestController
{
    
	/**
     * @Rest\Get("/article")
     */
    public function readAction()
    {
      $restresult = $this->getDoctrine()->getRepository('AppBundle:Article')->findAll();
        if ($restresult === null) {
          return new View("there are no article found.", Response::HTTP_NOT_FOUND);
        }
		    $view = $this->view($restresult, Response::HTTP_OK);
        return $view;
    }
	
	
	/**
     * @Rest\Get("/article/{id}")
     */
    public function readoneAction($id)
    {
      $singleresult = $this->getDoctrine()->getRepository('AppBundle:Article')->find($id);
       if ($singleresult === null) {
        return new View("article not found", Response::HTTP_NOT_FOUND);
       }
       $view = $this->view($singleresult, Response::HTTP_OK);
       return $view;
    }
	
	
	/**
	 * @Rest\Post("/article")
	 */
	public function postAction(Request $request)
	{
	  
	}
	
	
	
}
