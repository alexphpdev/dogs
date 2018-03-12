<?

namespace App;

use App\Cynologist\Cynologist;
use Exception;

class App
{
    public function cli(): void
    {
        echo "Введи породу собаки и команду, которую она должна выполнить\n";
        echo "Введи 'exit' чтобы выйт из программы\n";

        try {
            $line = trim(fgets(STDIN));
            $this->parseCommandLine($line);
            echo "\n";
        } catch (Exception $e) {
            echo $e->getMessage();
            echo "\n\n\n";
            return;
        }

        echo $this->executeCommand();
        echo "\n\n\n";
    }

    private function parseCommandLine($line): void
    {
        if (empty($line)) {
            throw new Exception("Вы забыли ввести породу собаки и команду, которую она должна выполнить");
        }

        if ('exit' == $line) {
            echo "Спасибо, что воспользовались нашей программой!";
            exit;
        }

        list($rawBreed, $rawCommand) = $this->splitBreedAndCommnd($line);

        $this->breed = $this->parseBreed($rawBreed);
        $this->command = $this->parseCommand($rawCommand);
    }

    private function splitBreedAndCommnd($line): array
    {
        $lastSpaceIndex = strrpos($line, ' ');
        if ($lastSpaceIndex === false) {
            throw new Exception("Между названием породы и командой, должен быть пробел!");
        }

        $rawBreed = substr($line, 0, $lastSpaceIndex);
        $rawCommand = substr($line, $lastSpaceIndex+1);

        return [$rawBreed, $rawCommand];
    }

    private function executeCommand(): string
    {
        Cynologist::setTask($this->breed, $this->command);
        return Cynologist::executeTask();
    }

    private function parseBreed($rawBreed): string
    {
        $rawBreed = strtolower($rawBreed);
        $breedsMask = [
            "ShibaInu" => "сиба-ину|сибаину|сиба ину|shiba inu|shibainu|shiba-inu|柴犬",
            "Pug" => "мопс|mops|pug",
            "Dachshund" => "такса|dachshund|badger|badger dog|badgerdog",
            "LabradorPlush" => "плюшевый лабрадор|плюшевыйлабрадор|лабрадор|лабрадор-ретривер|плюшевый лабрадор-ретривер|лабрадор ретривер|плюшевый лабрадор ретривер|лабрадорретривер|плюшевый лабрадорретривер|labrador retriever|plush labrador retriever|labrador|plush labrador|labrador plush",
            "DachshundRubber" => "резиновая такса с пищалкой|такса с пищалкой|такса-пищалка|такса пищалка|rubber dachshund|rubberdachshund|dachshundrubber|dachshund rubber",
        ];

        try {
            $dogClassName = $this->findMaskKey($breedsMask, $rawBreed);
        } catch (Exception $e) {
            throw new Exception("Нет совпадений с существующими породами собак, попробуйте ввести другую породу!");
        }

        return $dogClassName;
    }

    private function parseCommand($rawCommand): string
    {
        $rawCommand = strtolower($rawCommand);
        $commandsMask = [
            "sound" => "sound|sounds|noise|звук|звуки|лаять|лай|bark|bay|yelp|speak|пищать|пищи|squeak|peep|cheep",
            "hunt" => "hunt|hunting|охота|охоться",
        ];

        try {
            $methodName = $this->findMaskKey($commandsMask, $rawCommand);
        } catch (Exception $e) {
            throw new Exception("Нет совпадений с командами, которые хоть как-то умеют выполнять собаки!");
        }

        return $methodName;
    }

    private function findMaskKey($mask, $needle): string
    {
        foreach ($mask as $key => $mask) {
            $aliases = explode('|', $mask);
            $result = array_search($needle, $aliases);
            if (false !== $result) {
                return $key;
            }
        }

        throw new Exception;
    }
}
