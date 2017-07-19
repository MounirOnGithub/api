<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

/**
 * Article controller.
 */
class ArticleController extends Controller
{
    /**
     * @Rest\View()
     * @Rest\Get("api/articles")
     */
    public function getArticlesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('AppBundle:Article')->findAll();

        return $articles;
    }

    /**
     * @Rest\View()
     * @Rest\Get("api/articles/{id}")
     */
    public function getArticleAction(Article $article)
    {    
        return $article;
    }

    /**
     * @Rest\View()
     * @Rest\Post("api/admin/article")
     */
    public function postArticleAction(Request $request)
    {
        $title = $request->request->get('title');
        $content = $request->request->get('content');

        $article = new Article();
        $article->setTitle($title);
        $article->setContent($content);

        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();

        return $article;
    }

    /**
     * @Rest\View()
     * @Rest\Delete("api/admin/article/{id}")
     */
    public function deleteArticleAction(Article $article)
    {
        if (!$article) {
            throw $this->createNotFoundException('No article found');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($article);
        $em->flush();
    }

    /**
     * @Rest\View()
     * @Rest\Put("api/admin/article/{id}")
     */
    public function updateArticleAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository(Article::class)->find($id);

        if (!$article) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $title = $request->request->get('title');
        if ($title) {
            $article->setTitle($title);
        }

        $content = $request->request->get('content');
        if ($content) {
            $article->setContent($content);
        }
        $em->flush();

        return $article;
    }
}
