<?php

use Chetkov\ConsoleLogger\ConsoleLoggerFactory;
use Chetkov\ConsoleLogger\LoggerConfig;
use Chetkov\ConsoleLogger\StyledLogger\LoggerStyle;
use Chetkov\ConsoleLogger\StyledLogger\StyledLoggerDecorator;
use Chetkov\YaMapsParser\CsvExporter;
use Chetkov\YaMapsParser\Exception\EmptyResultException;
use Chetkov\YaMapsParser\Model\Point;
use Chetkov\YaMapsParser\Request\BBoxSearchRequest;
use Chetkov\YaMapsParser\Hydrator\PlaceHydrator;
use Chetkov\YaMapsParser\Request\CircleSearchRequest;
use Chetkov\YaMapsParser\SearchServiceFactory;

require_once 'vendor/autoload.php';

// Лимит, через сколько позиций яндекс включает offset вывода
const YANDEXLIMIT = 500;

set_time_limit(0);
if (!defined('ROOT_DIR')) {
    define('ROOT_DIR', __DIR__ . '/data');
}

$loggerConfig = (new LoggerConfig())
    ->setIsShowData(false)
    ->setIsShowLevel(false)
    ->setFieldDelimiter(': ');
$logger = new StyledLoggerDecorator(ConsoleLoggerFactory::create($loggerConfig), new LoggerStyle());

$logger->info('Перечислите через запятую КАТЕГОРИИ МЕСТ, которые необходимо спарсить: ');
$placeTypes = array_map('trim', explode(',', readline()));

$logger->info('Введите тип поиска (BBox - по прямоугольной области, Circle - в заданом радиусе от заданной точки), по умолчанию Circle: ');
$searchType = readline();
switch ($searchType) {
    case 'BBox':
        $logger->info('Введите координаты ЛЕВОГО НИЖНЕГО угла карты: ');
        $leftTopCoordinates = readline();
        [$leftBottomLat, $leftBottomLon] = explode(',', $leftTopCoordinates);

        $logger->info('Введите координаты ПРАВОГО ВЕРХНЕГО угла карты: ');
        $rightBottomCoordinates = readline();
        [$rightTopLat, $rightTopLon] = explode(',', $rightBottomCoordinates);

        $searchService = SearchServiceFactory::createBBoxSearchService('58a029de-144b-4bdb-9445-77be63899eb7');
        $request = new BBoxSearchRequest('', new Point($leftBottomLat, $leftBottomLon), new Point($rightTopLat, $rightTopLon));
        break;
    case 'Circle':
    default:
        $logger->info('Введите координаты центральной точки области поиска: ');
        $centerPointCoordinates = readline();
        [$lat, $lon] = explode(',', $centerPointCoordinates);

        $logger->info('Введите радиус поиска в КМ: ');
        $radius = readline();

        $searchService = SearchServiceFactory::createCircleSearchService('58a029de-144b-4bdb-9445-77be63899eb7');
        $request = new CircleSearchRequest('', new Point($lat, $lon), $radius);
        break;
}

foreach ($placeTypes as $placeType) {
    $csvExporter = new CsvExporter(ROOT_DIR . "/$placeType.csv", ';');

    $logger->info("Начинаем парсить: $placeType");

    $request->setSearchText($placeType);

    $csvExporter->write(['Название', 'Короткое название', 'Почтовый код', 'Адрес', 'URL', 'Телефоны', 'Категории', 'Часы работы', 'Ссылки',]);

    $offset = 0;
    $isEmptyResult = false;
    while (!$isEmptyResult) {
        try {
            $request->setOffset($offset);
            $places = $searchService->search($request);

            $count = count($places);
            $logger->info('ОК! Получено: ' . $count);
            if ($count >= YANDEXLIMIT) {
                $offset += $count;
            }
            else {
                $isEmptyResult = true;
            }
            
            foreach ($places as $place) {
                $isSuccess = $csvExporter->write(PlaceHydrator::getInstance()->extract($place));
                if (!$isSuccess) {
                    $logger->error("ОШИБКА записи в файл! {$place->getName()}, {$place->getAddress()}");
                }
            }
        } catch (EmptyResultException $e) {
            $isEmptyResult = true;
        }
    }
}