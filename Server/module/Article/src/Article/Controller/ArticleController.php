<?php

namespace Article\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Article\Model\Article;
use Article\Form\ArticleForm;

class ArticleController extends AbstractActionController
{
    protected $articleTable;

    public function indexAction()
    {
        return new ViewModel(array(
            'articles' => $this->getArticleTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
        $form = new ArticleForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $article = new Article();
            $form->setInputFilter($article->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $article->exchangeArray($form->getData());
                $this->getArticleTable()->saveArticle($article);

                // Redirect to list of albums
                return $this->redirect()->toRoute('article');
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('article', array(
                'action' => 'add'
            ));
        }

        try {
            $article = $this->getArticleTable()->getArticle($id);
        } catch (\Exception $ex) {
            return $this->redirect()->toRoute('article', array(
                'action' => 'index'
            ));
        }

        $form  = new ArticleForm();
        $form->bind($article);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($article->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getArticleTable()->savearticle($article);

                return $this->redirect()->toRoute('article');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('article');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getArticleTable()->deleteArticle($id);
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('article');
        }

        return array(
            'id'    => $id,
            'article' => $this->getArticleTable()->getArticle($id)
        );
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
