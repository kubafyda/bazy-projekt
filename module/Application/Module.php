<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\JsonModel;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

use Application\Entity;
use Application\Model;

class Module
{
     public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'MieszkanieTabela' =>  function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Entity\Mieszkanie());
                    $tableGateway = new TableGateway('mieszkanie',$dbAdapter,null,$resultSetPrototype,null);
                    
                    return new Model\MieszkanieTabela($tableGateway);
                },
                'OsobaTabela' =>  function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Entity\Osoba());
                    $tableGateway = new TableGateway('osoba',$dbAdapter,null,$resultSetPrototype,null);
                    
                    return new Model\OsobaTabela($tableGateway);
                },
                'MszaTabela' =>  function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Entity\Msza());
                    $tableGateway = new TableGateway('msza',$dbAdapter,null,$resultSetPrototype,null);
                    
                    return new Model\MszaTabela($tableGateway);
                },
                'KsiadzTabela' =>  function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Entity\Ksiadz());
                    $tableGateway = new TableGateway('ksiadz',$dbAdapter,null,$resultSetPrototype,null);
                    
                    return new Model\KsiadzTabela($tableGateway);
                },    
                'SakramentTabela' =>  function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Entity\Sakrament());
                    $tableGateway = new TableGateway('sakrament',$dbAdapter,null,$resultSetPrototype,null);
                    
                    return new Model\SakramentTabela($tableGateway);
                },      
                'GrobTabela' =>  function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Entity\Grob());
                    $tableGateway = new TableGateway('grob',$dbAdapter,null,$resultSetPrototype,null);
                    
                    return new Model\GrobTabela($tableGateway);
                },       
                'PogrzebTabela' =>  function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Entity\Pogrzeb());
                    $tableGateway = new TableGateway('pogrzeb',$dbAdapter,null,$resultSetPrototype,null);
                    
                    return new Model\PogrzebTabela($tableGateway);
                },       
                'SlubTabela' =>  function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Entity\Slub());
                    $tableGateway = new TableGateway('slub',$dbAdapter,null,$resultSetPrototype,null);
                    
                    return new Model\SlubTabela($tableGateway);
                },   
                'ChrzestTabela' =>  function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Entity\Chrzest());
                    $tableGateway = new TableGateway('chrzest',$dbAdapter,null,$resultSetPrototype,null);
                    
                    return new Model\ChrzestTabela($tableGateway);
                },
            ),
        );
    }
    
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
        $eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR, array($this, 'onDispatchError'), 0);
        $eventManager->attach(MvcEvent::EVENT_RENDER_ERROR, array($this, 'onRenderError'), 0);
    }
    
    public function onDispatchError($e)
    {
        return $this->getJsonModelError($e);
    }

    public function onRenderError($e)
    {
        return $this->getJsonModelError($e);
    }
    
    public function getJsonModelError($e)
    {
        $error = $e->getError();
        if (!$error) {
            return;
        }

        $response = $e->getResponse();
        $exception = $e->getParam('exception');
        $exceptionJson = array();
        if ($exception) {
            $exceptionJson = array(
                'class' => get_class($exception),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'message' => $exception->getMessage(),
                'stacktrace' => $exception->getTraceAsString()
            );
        }

        $errorJson = array(
            'message'   => 'An error occurred during execution; please try again later.',
            'error'     => $error,
            'exception' => $exceptionJson,
        );
        if ($error == 'error-router-no-match') {
            $errorJson['message'] = 'Resource not found.';
        }

        $model = new JsonModel(array('errors' => array($errorJson)));

        $e->setResult($model);

        return $model;
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
