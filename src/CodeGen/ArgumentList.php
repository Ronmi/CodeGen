<?php
namespace CodeGen;
use Exception;
use CodeGen\Renderable;
use CodeGen\Raw;
use CodeGen\VariableDeflator;
use ArrayAccess;
use IteratorAggregate;
use ArrayIterator;

class ArgumentList implements Renderable, ArrayAccess, IteratorAggregate
{
    public $arguments;

    public function __construct(array $arguments = array()) 
    {
        $this->arguments = $arguments;
    }

    public function setArguments(array $args)
    {
        $this->arguments = $args;
    }

    public function add($arg) 
    {
        $this->arguments[] = $arg;
        return $this;
    }
    
    
    public function offsetExists($offset)
    {
        return isset($this->arguments[ $offset ]);
    }
    
    public function offsetGet($offset)
    {
        return $this->arguments[ $offset ];
    }
    
    public function offsetUnset($offset)
    {
        unset($this->arguments[$offset]);
    }

    public function offsetSet($offset, $value)
    {
        if ($offset) {
            $this->arguments[$offset] = $value;
        } else {
            $this->arguments[] = $value;
        }
    }

    public function getIterator()
    {
        return new ArrayIterator($this->arguments);
    }

    public function render(array $args = array())
    {
        $strs = array();
        foreach ($this->arguments as $arg) {
            $strs[] = VariableDeflator::deflate($arg);
        }
        return join(', ',$strs);
    }
}

