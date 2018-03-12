<?

namespace App\Dogs;

// сиба-ину
final class ShibaInu extends DogA
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
