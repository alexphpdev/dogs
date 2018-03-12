<?

namespace App\Dogs;

// Такса
final class Dachshund extends DogA
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
        return "hunting started...";
    }
}
