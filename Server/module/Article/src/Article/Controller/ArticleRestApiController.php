<?php

namespace Article\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Article\Model\Article;
use Article\Form\ArticleForm;
use Zend\Json\Json as jsonHandler;
use Zend\Http\Headers as headersHandler;

class ArticleRestApiController extends AbstractRestfulController
{
    protected $articleTable;


    public function getAllArticlesAction()
    {
        $allArticles = $this->getArticleTable()->fetchAll();

        $allArticlesAsJson = jsonHandler::encode($allArticles, true);
        $header = headersHandler::fromString('Content-Type: text/javascript');

        $responseBodyText = $this->request->getQuery('callback') . '(' . $allArticlesAsJson . ');';

        $this->response->setHeaders($header);
        $this->response->setContent($responseBodyText);

        return $this->response;
    }

    public function addArticleAction()
    {
        $articleTitle = jsonHandler::decode($this->request->getQuery('records'))->title;
        $articleContent = jsonHandler::decode($this->request->getQuery('records'))->content;

        $article = new Article();
        $article->title = $articleTitle;
        $article->content = $articleContent;

        $this->getArticleTable()->saveArticle($article);

        return $this->response;;
    }

    public function updateArticleAction()
    {
        $articleId = jsonHandler::decode($this->request->getQuery('records'))->id;
        $articleTitle = jsonHandler::decode($this->request->getQuery('records'))->title;
        $articleContent = jsonHandler::decode($this->request->getQuery('records'))->content;

        $articlesTable = $this->getArticleTable();

        $articleToUpdate = $articlesTable->getArticle($articleId);

        $articleToUpdate->title = $articleTitle;
        $articleToUpdate->content = $articleContent;

        $articlesTable->saveArticle($articleToUpdate);

        return $this->response;;
    }

    public function deleteArticleAction()
    {
        $articleId = jsonHandler::decode($this->request->getQuery('records'))->id;

        $this->getArticleTable()->deleteArticle($articleId);

        return $this->response;
    }

    public function getArticleTable()
    {
        if (!$this->articleTable) {
            $sm = $this->getServiceLocator();
            $this->articleTable = $sm->get('Article\Model\ArticleTable');
        }
        return $this->articleTable;
    }
}
