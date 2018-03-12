<?

namespace App\Cynologist;

use App\Dogs\DogI;

// It class detect what kind of method of classes it will make
class Cynologist
{

    private static $dogsNamespace = '\\App\\Dogs\\';

    /**
    * string name of class of breed
    */
    private static $dogBreed;

    /**
    * string name of function that dog must to do
    */
    private static $command;

    /**
    *
    * give order to cynologist
    *
    * @param string $dogBreed
    * @param string $command
    *
    */
    public static function setTask(string $dogBreed, string $command): void
    {
        self::$dogBreed = $dogBreed;
        self::$command = $command;
    }


    /**
    *
    * get result of cynologist command execution
    *
    * @return string
    */
    public static function executeTask(): string
    {
        $dog = self::callDog(self::$dogBreed);
        $dogResponse = self::useCommand($dog, self::$command);

        return $dogResponse;
    }

    /**
    *
    * WHO will be asked
    *
    */
    private static function callDog(string $dogBreed): DogI
    {
        $class = self::$dogsNamespace . $dogBreed;
        return $class::getInstance();
    }

    /**
    *
    * WHAT will be asked
    *
    */
    private static function useCommand(DogI $dog, string $command): string
    {
        return $dog->$command();
    }
}
