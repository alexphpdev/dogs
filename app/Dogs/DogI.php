<?

namespace App\Dogs;

/**
*
* Interface for Dogs
*
*/
interface DogI
{
    /**
    *
    * get info what dogs can 'say'
    *
    * @return string
    *
    */
    public function sound(): string;

    /**
    *
    * get info can dogs hunt
    *
    * @return string
    *
    */
    public function hunt(): string;
}
