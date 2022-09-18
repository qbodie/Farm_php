<?php

// Абстрактный класс для всех видов животных
abstract class Animal
{
    // Индекс - динамично меняется, а Id присваивает этот индекс, так получается, что у каждого животного уникальный регистрационный номер
    static $index = 1;
    public $animalId = 0;

    public function collectProduct()
    {

    }

    public function getName()
    {

    }
}

// Класс коровы наследуется от абстрактного класса
class Cow extends Animal
{
    // Конструктор класс, инициализируем продукт, который производит и регистрационный номер
    function __construct()
    {
        $this->animalId = parent::$index++;
        $this->product = 'Молоко';
    }

    function getName()
    {
        return 'Корова';
    }

    // Возвращает количество продукции
    function collectProduct()
    {
        return rand(8, 12);
    }
}

class Chicken extends Animal
{
    function __construct()
    {
        $this->animalId = parent::$index++;
        $this->product = 'Яйцо';
    }

    function getName()
    {
        return "Курица";
    }

    function collectProduct()
    {
        return rand(0, 1);
    }
}

class Farm
{
    public $yard = array();
    private $production;

    // Добавляет новый вид животный на ферму
    function addNewAnimalType($animal)
    {
        $this->yard[$animal->getName()] = array();
    }

    // Добавляет конкретное животное
    function addAnimal($animal)
    {
        array_push($this->yard[$animal->getName()], $animal);
    }

    // Предоставляет информацию о кол-ве животных на ферме
    function getInfo()
    {
        foreach ($this->yard as $type => $animal)
        {
            echo "Всего " . count($animal) . " $type" . PHP_EOL;
        }
    }

    // Собирает продукцию за один день
    function collectDailyProduction()
    {
        // Проходимся по массиву, чтобы посчитать продуктию разного типа
        foreach ($this->yard as $animals => $amount)
        {
            // Определяем тип продукции и подсчитываем его количество
            $type = $amount[0]->product;
            $sum = 0;
            $this->production[$type] = $sum;

            foreach ($amount as $animal)
            {
                $sum += $animal->collectProduct();
            }
            // Заносим в массив кол-во продукции
            $this->production[$type] += $sum;
        }
        return $this->production;
    }
}
