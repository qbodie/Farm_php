<?php

include 'models.php';

// Добавляет животных в количестве n
function addAnimals($n, $name, $animal)
{
    for ($i = 1; $i < $n+1; $i++)
    {
        $name->addAnimal($animal);
    }
}

// Собирает недельную продукцию
function collectWeeklyProduction($name)
{
    $result = $name->collectDailyProduction();
    for ($i = 1; $i < 7; $i++)
    {
        $temp = $name->collectDailyProduction();
        foreach ($result as $type => $amount)
        {
            $result[$type] += $temp[$type];
        }
    }
    print_r($result);

}

// Инициализация и заполнение фермы
function main($name)
{
    $name = new Farm();
    $name->addNewAnimalType(new Cow());
    $name->addNewAnimalType(new Chicken());
    addAnimals(10, $name, new Cow());
    addAnimals(20, $name, new Chicken());
    $name->getInfo();
    collectWeeklyProduction($name);
    addAnimals(1, $name, new Cow());
    addAnimals(5, $name, new Chicken());
    $name->getInfo();
    collectWeeklyProduction($name);
}

main("farm");