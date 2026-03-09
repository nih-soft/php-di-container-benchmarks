<?php

declare(strict_types=1);

namespace DiContainerBenchmarks\Test;

use JsonException;

use function array_key_exists;
use function is_array;
use function is_numeric;
use function json_decode;
use function json_encode;

use const JSON_THROW_ON_ERROR;

final class TestResult
{
    private ?float $timeConsumption;
    private ?float $peakMemoryUsage;
    private string $message;

    public static function createUnsuccessful(string $message): TestResult
    {
        return new TestResult(null, null, $message);
    }

    public static function createFromJson(string $json): TestResult
    {
        try {
            $result = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException) {
            return new TestResult(null, null, "Invalid JSON response: \"$json\"");
        }

        if (!is_array($result)
            || !array_key_exists("time", $result)
            || !array_key_exists("memory", $result)
            || !array_key_exists("message", $result)
        ) {
            return new TestResult(null, null, "Invalid JSON structure: \"$json\"");
        }

        $time = $result["time"];
        $memory = $result["memory"];
        $message = (string) $result["message"];

        if (($time !== null && !is_numeric($time)) || ($memory !== null && !is_numeric($memory))) {
            return new TestResult(null, null, "Invalid JSON payload types: \"$json\"");
        }

        return new TestResult(
            $time !== null ? (float) $time : null,
            $memory !== null ? (float) $memory : null,
            $message
        );
    }

    public static function createFromMeasurement(
        float $startNanoseconds,
        float $endNanoseconds,
        int $peakMemoryUsageInBytes
    ): TestResult {
        return new TestResult(
            ($endNanoseconds - $startNanoseconds) / 1000000,
            $peakMemoryUsageInBytes / 1024 / 1024
        );
    }

    public static function createFromValues(
        ?float $timeConsumptionInMilliseconds,
        ?float $peakMemoryUsageInMegaBytes
    ): TestResult {
        return new TestResult($timeConsumptionInMilliseconds, $peakMemoryUsageInMegaBytes);
    }

    private function __construct(?float $timeConsumptionInMilliseconds, ?float $peakMemoryUsageInMegaBytes, string $message = "")
    {
        $this->timeConsumption = $timeConsumptionInMilliseconds;
        $this->peakMemoryUsage = $peakMemoryUsageInMegaBytes;
        $this->message = $message;
    }

    public function getTimeConsumptionInMilliSeconds(): ?float
    {
        return $this->timeConsumption;
    }

    public function getPeakMemoryUsageInMegaBytes(): ?float
    {
        return $this->peakMemoryUsage;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function isSuccessful(): bool
    {
        return $this->timeConsumption !== null && $this->peakMemoryUsage !== null;
    }

    public function toJson(): string
    {
        return json_encode(
            [
                "time" => $this->timeConsumption,
                "memory" => $this->peakMemoryUsage,
                "message" => $this->message,
            ],
            JSON_THROW_ON_ERROR
        );
    }
}
