<?php

declare(strict_types=1);

namespace tests;

use PHPUnit\Framework\TestCase;
use App\Dogs;

final class CliTest extends TestCase
{

    private $use = 'App\\Dogs\\';

    /**
     * @dataProvider dogsClassProvider
     */
    public function testSingletone($dogClass): void
    {

        $dogFirstCall = ($this->use . $dogClass)::getInstance();
        $dogSecondCall = ($this->use . $dogClass)::getInstance();

        $this->assertInstanceOf(Dogs\DogI::class, $dogFirstCall);
        $this->assertSame($dogFirstCall, $dogSecondCall);
    }

    /**
     * @dataProvider dogsClassProvider
     */
    public function testFailCreaeteObject($dogClass): void
    {
        $this->expectException('Error');

        $dogFullNameClass = $this->use . $dogClass;

        new $dogFullNameClass;
    }

    public function dogsClassProvider(): array
    {
        return [
            ['Pug'], ['LabradorPlush'], ['Dachshund'], ['DachshundRubber'], ['ShibaInu']
        ];
    }

    public function testEmptyInput(): void
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('Вы забыли ввести породу собаки и команду, которую она должна выполнить');

        $this->invokeMethod(new \App\App, 'parseCommandLine', ['']);
    }

    public function testWrongBreedInput(): void
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('Нет совпадений с существующими породами собак, попробуйте ввести другую породу!');

        $this->invokeMethod(new \App\App, 'parseCommandLine', ['wrongBreed command']);
    }

    public function testWrongCommandInput(): void
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('Нет совпадений с командами, которые хоть как-то умеют выполнять собаки!');

        $this->invokeMethod(new \App\App, 'parseCommandLine', ['mops wrongCommand']);
    }

    public function testJoinedLineInput(): void
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('Между названием породы и командой, должен быть пробел!');

        $this->invokeMethod(new \App\App, 'parseCommandLine', ['JoinedLine']);
    }

    private function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    public function testCynologistSetTaskTypeError(): void
    {
        $this->expectException('TypeError');
        \App\Cynologist\Cynologist::setTask(1, 1);
    }
}
