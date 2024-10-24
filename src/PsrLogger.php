<?php

namespace hiqdev\yii\compat;

use Psr\Log\LogLevel;
use yii\log\Logger;

class PsrLogger implements \Psr\Log\LoggerInterface
{
    use \Psr\Log\LoggerTrait;

    private const MAP = [
        LogLevel::EMERGENCY => Logger::LEVEL_ERROR,
        LogLevel::ALERT     => Logger::LEVEL_ERROR,
        LogLevel::CRITICAL  => Logger::LEVEL_ERROR,
        LogLevel::ERROR     => Logger::LEVEL_ERROR,
        LogLevel::WARNING   => Logger::LEVEL_WARNING,
        LogLevel::NOTICE    => Logger::LEVEL_INFO,
        LogLevel::INFO      => Logger::LEVEL_INFO,
        LogLevel::DEBUG     => Logger::LEVEL_TRACE,
    ];

    /**
     * @var Logger
     */
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function log($level, $message, array $context = []): void
    {
        if ($context === []) {
            $resultMessage = $message;
        } else {
            $resultMessage = array_merge(['message' => $message], $context);
        }

        $this->logger->log($resultMessage, $this->convertLevel($level));
    }

    private function convertLevel(string $logLevel): int
    {
        return self::MAP[$logLevel] ?? $logLevel;
    }
}
