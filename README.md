# Парсер ID групп ВКонтакте

Данная библиотека позволяет легко и просто получить список ID групп ВКонаткте по определенному запросу.

## Использование

Установите пакет используя:

```bash
composer require gelmutdm/vk-group-parser
```

## Пример использования

```php
$excludedIds = [
    1111111,
];

$result = (new Parser())
    ->setAccessToken("your_access_token")
    ->setExitFilePath("result.txt")
    ->setExcudedIds($excludedIds)
    ->setQ("Музыка")
    ->setCount(500)
    ->parse();
```