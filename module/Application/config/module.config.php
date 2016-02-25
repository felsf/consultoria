<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            
           'requests' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/requests/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Requests',
                        'action'        => 'index',
                    ),
                ),
            ),

           'email' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/email/edit/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Email',
                        'action'        => 'edit',
                    ),
                ),                
            ),

           'requests-read' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/requests/read/:id/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Requests',
                        'action'        => 'read',
                    ),
                ),
                'constraints' => array(
                    'id' => '[0-9]+',
                ),
            ),

           'articles' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/articles/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'articles',
                    ),
                ),
            ),

           'hiring-info' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/hiring/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'hiring',
                    ),
                ),
            ),                       

           'contact' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/contact/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Requests',
                        'action'        => 'add',
                    ),
                ),
            ),

           'videos' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/videos/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Videos',
                        'action'        => 'index',
                    ),
                ),
            ),

           'videos-list' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/videos/list/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Videos',
                        'action'        => 'list',
                    ),
                ),
            ),

           'videos-add' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/videos/add/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Videos',
                        'action'        => 'add',
                    ),
                ),
            ),

           'videos-delete' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/videos/delete/:id/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Videos',
                        'action'        => 'delete',
                    ),
                ),
                'constraints' => array(
                    'id' => '[0-9]+',
                ),
            ),

           'videos-toggle' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/videos/toggle/:id/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Videos',
                        'action'        => 'toggle',
                    ),
                ),
                'constraints' => array(
                    'id' => '[0-9]+',
                ),
            ),

           'chat' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/chat/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Chat',
                        'action'        => 'index',
                    ),
                ),
            ),
            
            'chat-welcome' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/chat/welcome/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Chat',
                        'action'        => 'welcome',
                    ),
                ),
            ),
            

           'chat-start' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/chat/start/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Chat',
                        'action'        => 'start',
                    ),
                ),
            ),
            
            'chat-send' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/chat/send/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Chat',
                        'action'        => 'send',
                    ),
                ),
            ),

            'chat-display' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/chat/display/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Chat',
                        'action'        => 'display',
                    ),
                ),
            ),

            'comments' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/comments/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Comments',
                        'action'        => 'index',
                    ),
                ),
            ),
            
            'comments-add' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/comments/add/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Comments',
                        'action'        => 'add',
                    ),
                ),
            ),
            
            'comments-delete' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/comments/delete/:id/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Comments',
                        'action'        => 'delete',
                    ),
                ),
                'constraints' => array(
                    'id' => '[0-9]+',
                ),
            ),

            'patrocinadores' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/patrocinadores/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Patrocinadores',
                        'action'        => 'index',
                    ),
                ),
            ),

            'patrocinadores-add' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/patrocinadores/add/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Patrocinadores',
                        'action'        => 'add',
                    ),
                ),
            ),

            'patrocinadores-toggle' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/patrocinadores/toggle/:id/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Patrocinadores',
                        'action'        => 'toggle',
                    ),
                ),
            ),

            'patrocinadores-edit' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/patrocinadores/edit/:id/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Patrocinadores',
                        'action'        => 'edit',
                    ),
                ),
            ),

            'patrocinadores-delete' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/patrocinadores/delete/:id/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Patrocinadores',
                        'action'        => 'delete',
                    ),
                ),
            ),

            'images' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/images/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Images',
                        'action'        => 'index',
                    ),
                ),
            ),

            'images-toggle' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/images/toggle/:id/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Images',
                        'action'        => 'toggle',
                    ),
                ),
                'constraints' => array(
                    'id' => '[0-9]+',
                ),
            ),

            'images-delete' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/images/delete/:id/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Images',
                        'action'        => 'delete',
                    ),
                ),
                'constraints' => array(
                    'id' => '[0-9]+',
                ),
            ),


            'images-add' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/images/add/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Images',
                        'action'        => 'add',
                    ),
                ),
            ),

            'images-gallery' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/images/gallery/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Images',
                        'action'        => 'gallery',
                    ),
                ),
            ),
            
            'news' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/news/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'News',
                        'action'        => 'index',
                    ),
                ),
            ),
            
            'news-all' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/news/all/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'News',
                        'action'        => 'all',
                    ),
                ),
            ),
            
            'news-view' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/news/view/:id/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'News',
                        'action'        => 'view',
                    ),
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                ),
            ),
            
            'news-edit' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/news/edit/:id/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'News',
                        'action'        => 'edit',
                    ),
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                ),
            ),
            
            'news-delete' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/news/delete/:id/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'News',
                        'action'        => 'delete',
                    ),
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                ),
            ),
            
            'news-create' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/news/create/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'News',
                        'action'        => 'create',
                    ),
                ),
            ),
            
            'news-publish' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/news/publish/:id/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'News',
                        'action'        => 'publish',
                    ),
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                ),
            ),
            
            'questions' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/questions/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Questions',
                        'action'        => 'index',
                    ),
                ),
            ),

            'questions-list' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/questions/list/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Questions',
                        'action'        => 'list',
                    ),
                ),
            ),

            'questions-add' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/questions/add/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Questions',
                        'action'        => 'add',
                    ),
                ),
            ),

            'questions-list' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/questions/list/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Questions',
                        'action'        => 'list',
                    ),
                ),
            ),

            'questions-reply' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/questions/reply/:id/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Questions',
                        'action'        => 'reply',
                    ),
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                ),
            ),

            'questions-delete' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/questions/delete/:id/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Questions',
                        'action'        => 'delete',
                    ),
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                ),
            ),            
                
            'users' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/users/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Users',
                        'action'        => 'index',
                    ),
                ),
            ),
            
            'users-login' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/users/login/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Users',
                        'action'        => 'login',
                    ),
                ),
            ),
            
            'users-logout' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/users/logout/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Users',
                        'action'        => 'logout',
                    ),
                ),
            ),
            
            'users-register' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/users/register/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Users',
                        'action'        => 'register',
                    ),
                ),
            ),
            
            'users-edit' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/users/edit/:id/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Users',
                        'action'        => 'edit',
                    ),
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                ),
            ),
            
            'users-delete' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/users/delete/:id/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Users',
                        'action'        => 'delete',
                    ),
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                ),
            ),
            
            'users-block' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/users/block/:id/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Users',
                        'action'        => 'block',
                    ),
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                ),
            ),
            
            'users-unblock' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/users/unblock/:id/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Users',
                        'action'        => 'unblock',
                    ),
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                ),
            ),

            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),               

                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Users' => 'Application\Controller\UsersController',
            'Application\Controller\Questions' => 'Application\Controller\QuestionsController',
            'Application\Controller\Answers' => 'Application\Controller\AnswersController',
            'Application\Controller\News' => 'Application\Controller\NewsController',
            'Application\Controller\Comments' => 'Application\Controller\CommentsController',
            'Application\Controller\Patrocinadores' => 'Application\Controller\PatrocinadoresController',
            'Application\Controller\Images' => 'Application\Controller\ImagesController',
            'Application\Controller\Requests' => 'Application\Controller\RequestsController',
            'Application\Controller\Chat' => 'Application\Controller\ChatController',
            'Application\Controller\Videos' => 'Application\Controller\VideosController',
            'Application\Controller\Email' => 'Application\Controller\EmailController',
            
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),

    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        ),
        'authentication' => array(
            'orm_default' => array(
                'object_manager' => 'Doctrine\ORM\EntityManager',
                'identity_class' => 'Application\Entity\User',
                'identity_property' => 'userLogin',
                'credential_property' => 'userPassword',
            ),
        ),
    ),
);