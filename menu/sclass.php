<?php
class SomeClass
{
    // protected $_someMember; // Error: Access to undeclared static property: SomeClass::$_someMember
    
    protected static $_someMember = 1;

    public function __construct()
    {
        $this->_someMember = 1;
    }
    public static function getSomethingStatic()
    {
        // return $this->_someMember * 5; // Error: Using $this when not in object context 

        return self::$_someMember * 5;
    }
}

echo SomeClass::getSomethingStatic();


class SomeClassNew
{
    protected $_someMember;

    public function __construct()
    {
        $this->_someMember = 1;
    }
    public function getSomethingStatic()
    {
        return $this->_someMember * 5;
    }
}

$obj = new SomeClassNew();
echo $obj->getSomethingStatic();
