<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Article controller.
 */
class ArticleController extends Controller
{
    /**
     * @Rest\View()
     * @Rest\Get("/articles")
     */
    public function getArticlesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('AppBundle:Article')->findAll();

        return $articles;
    }

    /**
     * @Rest\View()
     * @Rest\Get("articles/{id}")
     */
    public function getArticleAction(Article $article)
    {    
        return $article;
    }
}
