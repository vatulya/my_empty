<?php

namespace Controller;

abstract class AbstractController
{

    const DEFAULT_ACTION = 'index';
    const DEFAULT_CONTROLLER = 'index';

    /**
     * @var array
     */
    protected $view = [];

    /**
     * @return null
     */
    abstract public function indexAction();

    /**
     * @param string $action
     * @param string $controller
     */
    static public function load($controller, $action)
    {
        if (empty($controller)) {
            $controller = self::DEFAULT_CONTROLLER;
        }
        if (empty($action)) {
            $action = self::DEFAULT_ACTION;
        }
        $class = '\Controller\\' . ucfirst(strtolower($controller));
        $method = ucfirst(strtolower($action)) . 'Action';
        if (!class_exists($class) || !is_callable([$class, $method], true)) {
//            die('Can\'t load "' . $class . '::' . $method . '"');
            die('Something wrong');
        }
        try {
            /** @var AbstractController $object */
            $object = new $class();
            $object->$method();
            $object->render($controller, $action);
        } catch (\Exception $e) {
//            die('Exception: "' . $e->getMessage() . '" (' . $e->getFile() . ':' . $e->getLine() . ')');
            die('Something wrong');
        }
    }

    /**
     * @param string $controller
     * @param string $action
     */
    public function render($controller, $action)
    {
        $file = sprintf('%s/%s.html', strtolower($controller), strtolower($action));
        echo self::getTwig()->render($file, $this->view);
    }

    /**
     * @return \Twig_Environment
     */
    static protected function getTwig()
    {
        $loader = new \Twig_Loader_Filesystem(APPLICATION_PATH . '/templates');
        return new \Twig_Environment($loader);
    }

}