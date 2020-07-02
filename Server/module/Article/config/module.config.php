<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Article\Controller\Article' => 'Article\Controller\ArticleController',
            'Article\Controller\ArticleRestApi' => 'Article\Controller\ArticleRestApiController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'article' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/article[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Article\Controller\Article',
                        'action'     => 'index',
                    ),
                ),
            ),
            'getAllArticles' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/get-all-articles',
                    'defaults' => array(
                        'controller' => 'Article\Controller\ArticleRestApi',
                        'action'     => 'getAllArticles',
                    ),
                ),
            ),
            'deleteArticle' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/delete-article',
                    'defaults' => array(
                        'controller' => 'Article\Controller\ArticleRestApi',
                        'action'     => 'deleteArticle',
                    ),
                ),
            ),
            'addArticle' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/add-article',
                    'defaults' => array(
                        'controller' => 'Article\Controller\ArticleRestApi',
                        'action'     => 'addArticle',
                    ),
                ),
            ),
            'updateArticle' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/update-article',
                    'defaults' => array(
                        'controller' => 'Article\Controller\ArticleRestApi',
                        'action'     => 'updateArticle',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'article' => __DIR__ . '/../view',
        ),
    ),
);
