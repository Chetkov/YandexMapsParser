<?php

namespace Chetkov\YaMapsParser;

/**
 * Class CsvExporter
 * @package Chetkov\YaMapsParser
 */
class CsvExporter
{
    public const DEFAULT_COLUMN_DELIMITER = ';';

    /**
     * @var resource
     */
    private $fileHandler;

    /**
     * @var string
     */
    private $delimiter;

    /**
     * CsvExporter constructor.
     * @param string $filename
     * @param string $delimiter
     */
    public function __construct(string $filename, string $delimiter = self::DEFAULT_COLUMN_DELIMITER)
    {
        $fileHandler = fopen($filename, 'ab');
        if (!$fileHandler) {
            throw new \RuntimeException('Не удалось получить дескриптор файла');
        }
        $this->fileHandler = $fileHandler;
        $this->delimiter = $delimiter;
    }

    public function __destruct()
    {
        if ($this->fileHandler) {
            fclose($this->fileHandler);
        }
    }

    /**
     * @param array $data
     * @return bool
     */
    public function write(array $data): bool
    {
        return (bool)fwrite($this->fileHandler, implode($this->delimiter, $data) . PHP_EOL);
    }
}
