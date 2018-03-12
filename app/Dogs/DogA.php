<?

namespace App\Dogs;

/**
*
* Abstract class for Dogs
* It suggests that inheritors will implements pattern singleton
*
*/
abstract class DogA implements DogI
{

    /**
    *
    * get instance of object
    *
    * @return DogI
    *
    */
    final public static function getInstance(): DogI
    {
        if (static::$instance) {
            return static::$instance;
        }
        return static::$instance = new static();
    }

    /**
    *
    * forbid cloning
    *
    */
    final private function __clone()
    {
    }
    /**
    *
    * forbid unserialize
    *
    */
    final private function __wakeup()
    {
    }
}
