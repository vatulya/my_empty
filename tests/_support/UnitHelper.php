<?php

namespace Codeception\Module;

class UnitHelper extends \Codeception\Module
{

    /**
     * @var array
     */
    protected $stubsToVerify = [];

    /**
     * @param string $exception
     * @param callable $function
     * @return bool
     */
    public function seeExceptionThrown($exception, $function)
    {
        try {
            $function();
        } catch (\Exception $e) {
            if (get_class($e) == $exception) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param object $object
     * @param string $propertyName
     * @return mixed
     */
    public function getProtectedProperty($object, $propertyName)
    {
        $class = new \ReflectionObject($object);
        $property = $class->getProperty($propertyName);
        $property->setAccessible(true);
        return $property->getValue($object);
    }

    /**
     * @param object $object
     * @param string $methodName
     * @param array $params
     * @return mixed
     */
    public function callProtectedMethod($object, $methodName, $params)
    {
        $class = new \ReflectionObject($object);
        $method = $class->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $params);
    }

    /**
     * @param mixed $result
     * @return callable
     */
    public function returnAsClosure($result)
    {
        return function() use ($result) { return $result; };
    }

    /**
     * @param object $stub
     * @return $this
     */
    public function addStubToVerify($stub)
    {
        $this->stubsToVerify[] = $stub;
        return $this;
    }

    /**
     * @return $this
     */
    public function verifyStubs()
    {
        foreach ($this->stubsToVerify as $stub) {
            $stub->__phpunit_getInvocationMocker()->verify();
        }
        return $this;
    }

    /**
     * @return $this
     */
    public function clearStubsToVerify()
    {
        $this->stubsToVerify = [];
        return $this;
    }

    /**
     * @return $this
     */
    public function clear()
    {
        return $this->clearStubsToVerify();
    }

}