<?

namespace App\Dogs;

// Мопс
final class Pug extends DogA
{
    protected static $instance;
    protected function __construct()
    {
    }

    public function sound(): string
    {
        return "woof! woof!";
    }

    public function hunt(): string
    {
        return "no-no-no, too lazy for hunting!";
    }
}
