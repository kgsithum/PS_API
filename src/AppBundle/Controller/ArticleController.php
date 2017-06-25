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
      //$restresult = $this->getDoctrine()->getRepository('AppBundle:Article')->findAll();

      $em = $this->getDoctrine()->getManager();
      $query = $em->createQuery(
            'SELECT a.id,a.title,ar.name as author,a.content as summary,a.url,a.createdAt
            FROM AppBundle:Article a 
            INNER JOIN AppBundle:Author ar
            WHERE a.id != :id'            
        )->setParameter('id', "");

        $restresult = $query->getResult();

        if (empty($restresult)) {
          return new View("there are no articles found.", Response::HTTP_NOT_FOUND);
        }
      //format return Array


      $view = $this->view($restresult, Response::HTTP_OK);
      return $view;
    }


	/**
     * @Rest\Get("/article/{id}")
     */
    public function readoneAction($id)
    {
      //$singleresult = $this->getDoctrine()->getRepository('AppBundle:Article')->find($id);
      $em = $this->getDoctrine()->getManager();
      $query = $em->createQuery(
            'SELECT a.id,a.title,ar.name as author,a.content,a.url,a.createdAt
            FROM AppBundle:Article a 
            INNER JOIN AppBundle:Author ar             
            WHERE a.id = :id'            
        )->setParameter('id', $id);

        $singleresult = $query->getResult();



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
        $data = new Article;
        $author_id = $request->get('author_id');
        $title = $request->get('title');
        $url = $request->get('url');
        $content = $request->get('content');

        //validations
        if($author_id ===null)
        {
            return new View("Please enter Author ID.", Response::HTTP_NOT_ACCEPTABLE);
        }else{

            //check valid author id
            $validAuthor = $this->getDoctrine()->getRepository('AppBundle:Author')->find($author_id);
            if ($validAuthor === null) {
                return new View("Please enter valid Author ID.", Response::HTTP_NOT_ACCEPTABLE);
            }

        }

        if($title ===null)
        {
            return new View("Please enter Title.", Response::HTTP_NOT_ACCEPTABLE);
        }
        if($url ===null)
        {
            return new View("Please enter URL.", Response::HTTP_NOT_ACCEPTABLE);
        }
        $data->setAuthorId($validAuthor);
        $data->setTitle($title);
        $data->setUrl($url);
        $data->setContent($content);

        $currenttime = new \DateTime();
        $data->setCreatedAt($currenttime);
        $data->setUpdatedAt($currenttime);

        $em = $this->getDoctrine()->getManager();
        $em->persist($data);

        $em->flush();

        $view = $this->view("Article Added Successfully", Response::HTTP_OK);
        return $view;
	}


    /**
	 * @Rest\Put("/article/{id}")
	 */
	public function updateAction($id,Request $request)
	{

        $author_id = $request->get('author_id');
        $title = $request->get('title');
        $url = $request->get('url');
        $content = $request->get('content');


        //validations

        //check for valid article
        $article = $this->getDoctrine()->getRepository('AppBundle:Article')->find($id);
        if($article === null){
            return new View("Please provide valid article.", Response::HTTP_NOT_ACCEPTABLE);
        }
        if($author_id !== null)
        {
            //check valid author id
            $validAuthor = $this->getDoctrine()->getRepository('AppBundle:Author')->find($author_id);
            if ($validAuthor === null) {
                return new View("Please enter valid Author ID.", Response::HTTP_NOT_ACCEPTABLE);
            }else{
                $article->setAuthorId($validAuthor);
            }
        }

        if($title !== null)
        {
            $article->setTitle($title);
        }
        if($url !== null)
        {
            $article->setUrl($url);
        }
        if($content !== null)
        {
            $article->setContent($content);
        }


        $currenttime = new \DateTime();
        $article->setUpdatedAt($currenttime);

        $em = $this->getDoctrine()->getManager();
        $em->persist($article);

        $em->flush();

        $view = $this->view("Article Updated Successfully", Response::HTTP_OK);
        return $view;
	}


    /**
     * @Rest\Delete("/article/{id}")
     */
    public function deleteAction($id)
    {
        $data = new Article;
        $em = $this->getDoctrine()->getManager();
        $article = $this->getDoctrine()->getRepository('AppBundle:Article')->find($id);
        if (empty($article)) {
            return new View("Article not found", Response::HTTP_NOT_FOUND);
        }
        else {
            $em->remove($article);
            $em->flush();
        }
        return new View("Article deleted successfully", Response::HTTP_OK);
    }



}
