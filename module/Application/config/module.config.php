<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

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
            'ajax' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/ajax/:id/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'ajax',
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
                    'route'    => '/users/edit/:id',
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
                    'route'    => '/users/delete/:id',
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
                    'route'    => '/users/block/:id',
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
                    'route'    => '/users/unblock/:id',
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
                'identity_class' => 'Users\Entity\User',
                'identity_property' => 'user_login',
                'credential_property' => 'user_password',
            ),
        ),
    ),
);