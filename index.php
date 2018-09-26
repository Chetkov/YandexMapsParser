<?php

use Chetkov\ConsoleLogger\ConsoleLogger;
use Chetkov\ConsoleLogger\StyledLogger\LoggerStyle;
use Chetkov\ConsoleLogger\StyledLogger\StyledLoggerDecorator;
use Chetkov\YaMapsParser\CsvExporter;
use Chetkov\YaMapsParser\Model\Point;
use Chetkov\YaMapsParser\Request\BBoxSearchRequest;
use Chetkov\YaMapsParser\Hydrator\PlaceHydrator;
use Chetkov\YaMapsParser\Request\CircleSearchRequest;
use Chetkov\YaMapsParser\SearchServiceFactory;

require_once 'vendor/autoload.php';
set_time_limit(0);
if (!defined('ROOT_DIR')) {
    define('ROOT_DIR', __DIR__ . '/data');
}

$logger = new StyledLoggerDecorator(new ConsoleLogger(), new LoggerStyle());

$placeTypes = array_map('trim', explode(',', readline('Перечислите через запятую КАТЕГОРИИ МЕСТ, которые необходимо спарсить: ')));

$searchType = readline('Введите тип поиска (BBox - по прямоугольной области, Circle - в заданом радиусе от заданной точки), по умолчанию Circle: ');
switch ($searchType) {
    case 'BBox':
        $leftTopCoordinates = readline('Введите координаты ЛЕВОГО НИЖНЕГО угла карты: ');
        [$leftBottomLat, $leftBottomLon] = explode(',', $leftTopCoordinates);

        $rightBottomCoordinates = readline('Введите координаты ПРАВОГО ВЕРХНЕГО угла карты: ');
        [$rightTopLat, $rightTopLon] = explode(',', $rightBottomCoordinates);

        $searchService = SearchServiceFactory::createBBoxSearchService('58a029de-144b-4bdb-9445-77be63899eb7');
        $request = new BBoxSearchRequest('', new Point($leftBottomLat, $leftBottomLon), new Point($rightTopLat, $rightTopLon));
        break;
    case 'Circle':
    default:
        $centerPointCoordinates = readline('Введите координаты центральной точки области поиска: ');
        [$lat, $lon] = explode(',', $centerPointCoordinates);

        $radius = readline('Введите радиус поиска в КМ: ');

        $searchService = SearchServiceFactory::createCircleSearchService('58a029de-144b-4bdb-9445-77be63899eb7');
        $request = new CircleSearchRequest('', new Point($lat, $lon), $radius);
        break;
}

foreach ($placeTypes as $placeType) {
    $csvExporter = new CsvExporter(ROOT_DIR . "/$placeType.csv", ';');

    $logger->info("Начинаем парсить: $placeType");

    $request->setSearchText($placeType);
    $places = $searchService->search($request);

    $logger->info('ОК! Получено: ' . count($places));

    $csvExporter->write(['Название', 'Короткое название', 'Почтовый код', 'Адрес', 'URL', 'Телефоны', 'Категории', 'Часы работы', 'Ссылки',]);
    foreach ($places as $place) {
        $isSuccess = $csvExporter->write(PlaceHydrator::getInstance()->extract($place));
        if (!$isSuccess) {
            $logger->error("ОШИБКА записи в файл! {$place->getName()}, {$place->getAddress()}");
        }
    }
}