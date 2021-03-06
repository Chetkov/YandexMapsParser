<?php

namespace Chetkov\YaMapsParser\Translator;

/**
 * Class LongitudeDistanceTranslator
 * @package Chetkov\YaMapsParser\Translator
 */
final class LongitudeDistanceTranslator extends DistanceTranslator
{
    /**
     * Длина паралели в одном градусе (ед. измерения - КМ)
     * @var array
     */
    private const KM_IN_ONE_DEGREE = [
        0 => 111.3,     15 => 107.6,    30 => 96.5,     45 => 78.8,     60 => 55.8,     75 => 28.9,
        1 => 111.3,     16 => 107.0,    31 => 95.5,     46 => 77.5,     61 => 54.1,     76 => 27.0,
        2 => 111.3,     17 => 106.5,    32 => 94.5,     47 => 76.1,     62 => 52.4,     77 => 25.1,
        3 => 111.2,     18 => 105.9,    33 => 93.5,     48 => 74.6,     63 => 50.7,     78 => 23.2,
        4 => 111.1,     19 => 105.3,    34 => 92.4,     49 => 73.2,     64 => 48.9,     79 => 21.3,
        5 => 110.9,     20 => 104.6,    35 => 91.3,     50 => 71.7,     65 => 47.2,     80 => 19.4,
        6 => 110.7,     21 => 104.0,    36 => 90.2,     51 => 70.2,     66 => 45.4,     81 => 17.5,
        7 => 110.5,     22 => 103.3,    37 => 89.0,     52 => 68.7,     67 => 43.6,     82 => 15.5,
        8 => 110.2,     23 => 102.5,    38 => 87.8,     53 => 67.1,     68 => 41.8,     83 => 13.6,
        9 => 110.0,     24 => 101.8,    39 => 86.6,     54 => 65.6,     69 => 40.0,     84 => 11.7,
        10 => 109.6,    25 => 101.0,    40 => 85.4,     55 => 64.0,     70 => 38.2,     85 => 9.7,
        11 => 109.3,    26 => 100.1,    41 => 84.1,     56 => 62.4,     71 => 36.4,     86 => 7.8,
        12 => 108.9,    27 => 99.3,     42 => 82.9,     57 => 60.8,     72 => 34.5,     87 => 5.8,
        13 => 108.5,    28 => 98.4,     43 => 81.5,     58 => 59.1,     73 => 32.6,     88 => 3.9,
        14 => 108.0,    29 => 97.4,     44 => 80.2,     59 => 57.5,     74 => 30.8,     89 => 1.9,
        90 => 0,
    ];

    /**
     * @param float $latitude
     * @return float|null
     */
    public function getKmInOneDegree(float $latitude): ?float
    {
        return self::KM_IN_ONE_DEGREE[(int)round(abs($latitude))] ?? null;
    }
}
