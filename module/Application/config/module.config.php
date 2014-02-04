<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
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
                            'route'    => '/[:controller[/:action][/:id]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'         => '[0-9]+'
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            'mieszkania' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/mieszkania[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Mieszkanie',
                    ),
                ),
            ),
            'osoby' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/osoby[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Osoba',
                    ),
                ),
            ),
            'msze' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/msze[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Msza',
                    ),
                ),
            ),
            'ksieza' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/ksieza[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Ksiadz',
                    ),
                ),
            ),
            /** 
             * Sakrament
             */
            'sakramenty' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/sakramenty[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Sakrament',
                    ),
                ),
            ),
            
            /*
             * pogrzeb
             */
            'pogrzeby' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/pogrzeby[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Pogrzeb',
                    ),
                ),
            ),
            /*
             * groby
             */
            'groby' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/groby[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Grob',
                    ),
                ),
            ),
            /*
             * slub
             */
            /*
              'osoba' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/osoba[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Osoba',
                    ),
                ),
            ),
            */
            /*
             * chrzest
             */
            /*
              'osoba' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/osoba[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Osoba',
                    ),
                ),
            ),
            */

            
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Mieszkanie' => 'Application\Controller\MieszkanieController',
            'Application\Controller\Osoba' => 'Application\Controller\OsobaController',
            'Application\Controller\Msza' => 'Application\Controller\MszaController',
            'Application\Controller\Ksiadz' => 'Application\Controller\KsiadzController',
            'Application\Controller\Sakrament' => 'Application\Controller\SakramentController',
            'Application\Controller\Grob' => 'Application\Controller\GrobController',
            'Application\Controller\Pogrzeb' => 'Application\Controller\PogrzebController',
        ),
    ),
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy'
        )
    ),
);
