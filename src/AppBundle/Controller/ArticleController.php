<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\View\ViewHandler;
use FOS\RestBundle\View\View;

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
        foreach ($articles as $article) {
            $formatted[] = [
                'id' => $article->getId(),
                'title' => $article->getTitle(),
                'content' => $article->getContent(),
                'createdAt' => $article->getCreatedAt(),
                'updatedAt' => $article->getUpdatedAt(),
            ];
        }

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
