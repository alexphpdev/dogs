<?

namespace App\Dogs;

// резиновая такса с пищалкой
final class DachshundRubber extends DogA
{
    protected static $instance;
    protected function __construct()
    {
    }

    public function sound(): string
    {
        return "squeak-squeak!";
    }

    public function hunt(): string
    {
        return "* I can't hunting, I'm rubber :(";
    }
}
