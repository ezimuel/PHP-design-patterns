<?php
/**
 * Proxy design pattern (consuming and controlling access to another object)
 * 
 * @author Enrico Zimuel (enrico@zimuel.it) 
 * @see    http://mwop.net/blog/263-Proxies-in-PHP.html
 */

class SomeObject
{
    protected $message;
    
    public function __construct($message)
    {
        $this->message = $message;
    }
    
    protected function doSomething() {
        return $this->message;
    }
}

class Proxy extends SomeObject 
{
    protected $proxied;

    public function __construct(SomeObject $o)
    {
        $this->proxied = $o;
    }
    
    public function doSomething()
    {
        return ucwords($this->proxied->doSomething());
    }
}

// Usage example

$o = new SomeObject('foo bar');
$p = new Proxy($o);
printf("Message from Proxy: %s\n", $p->doSomething());
