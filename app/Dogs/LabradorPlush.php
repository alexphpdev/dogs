<?

namespace App\Dogs;

// плюшевый лабрадор
final class LabradorPlush extends DogA
{
    protected static $instance;
    protected function __construct()
    {
    }

    public function sound(): string
    {
        return "* I can't make sounds, I'm plush :(";
    }

    public function hunt(): string
    {
        return "* I can't hunting, I'm plush :(";
    }
}
