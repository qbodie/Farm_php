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
    // Создаём объект класса Farm
    $name = new Farm();

    // Добавляем новые виды животных
    $name->addNewAnimalType(new Cow());
    $name->addNewAnimalType(new Chicken());

    // Добавляем 10 коров и 20 куриц
    addAnimals(10, $name, new Cow());
    addAnimals(20, $name, new Chicken());

    // Получаем информацию о ферме и собираем продукцию
    $name->getInfo();
    collectWeeklyProduction($name);

    // Докупили 1 корову и 5 куриц
    addAnimals(1, $name, new Cow());
    addAnimals(5, $name, new Chicken());

    // Получаем обновлённую информацию о ферме и собираем продукцию
    $name->getInfo();
    collectWeeklyProduction($name);
}

// Вызов инициализирующей функции
main("farm");