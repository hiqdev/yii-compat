<?php

namespace hiqdev\yii\compat;

use yii\log\Logger;

class PsrLogger implements \Psr\Log\LoggerInterface
{
    use \Psr\Log\LoggerTrait;

    /**
     * @var Logger
     */
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function log($level, $message, array $context = [])
    {
        $this->logger->log($message, $this->convertLevel($level), $context);
    }

    private function convertLevel(string $string): int
    {
        if ($string === 'debug') {
            return Logger::LEVEL_TRACE;
        } elseif ($string === 'info') {
            return Logger::LEVEL_INFO;
        } elseif ($string === 'info') {
            return Logger::LEVEL_WARNING;
        }

        return Logger::LEVEL_ERROR;
    }
}
