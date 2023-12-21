<?php

namespace App\Helpers;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Hash;

class Utils
{
    /**
     * Converts string to title case.
     *
     * @param string $value
     * @return string
     */
    public static function setValue(string $value): string
    {
        return ucwords(strtolower($value));
    }

    public static function dateFormat($dateTime)
    {
        if (empty($dateTime)) return $dateTime;
        return Carbon::parse($dateTime)->format(config("settings.date_format"));
    }

    /**
     * Returns the file size in bytes for a base64-encoded file string.
     *
     * @param string $file
     * @return int
     */
    public static function getFileSize(string $file): int
    {
        return strlen(base64_decode($file));
    }

    /**
     * Returns the full URL including query parameters.
     *
     * @return false|mixed|string
     */
    public static function getFullUrl(): mixed
    {
        $mainUrl = self::getHostName();
        if (isset($_SERVER['REQUEST_URI'])) {
            $mainUrl .= $_SERVER['REQUEST_URI'];
        }
        return $mainUrl;
    }

    /**
     * Returns the host name from the server variable.
     * In production environment, it extracts the hostname from the full URL.
     *
     * @return false|mixed
     */
    public static function getHostName(): mixed
    {
        $hostName = @$_SERVER["HTTP_HOST"];
        if (config('app.env') === 'production') {
            $hostName = parse_url($hostName);
            $hostName = reset($hostName);
        }
        return $hostName;
    }

    /**
     * Get Time Difference
     *
     * @param $currentDateTime
     * @param $targetDateTime
     * @return int
     */
    public static function getTimeDifference($currentDateTime, $targetDateTime): int
    {
        // Get the current date and time
        $now = $currentDateTime instanceof Carbon ? $currentDateTime : Carbon::parse($currentDateTime);

        // Check if the user has made a failed attempt within the last 2 minutes
        $lastAttempt = $targetDateTime instanceof Carbon ? $targetDateTime : Carbon::parse($targetDateTime);

        // Check if the time difference between the last attempt and current time exceeds the blocked duration
        return $now->diffInMinutes($lastAttempt);
    }

    /**
     * Get Ip
     *
     * @return string|null
     */
    public static function getIp(): ?string
    {
        return request()->ip();
    }

    /**
     * Generate Code
     *
     * @return string|null
     * @throws Exception
     */
    public static function generateCode(): ?string
    {
        return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    /**
     * Generate Expire Date
     *
     * @return string|null
     */
    public static function generateExpireDate(): ?string
    {
        return now()->addMinutes(SettingHelper::getExpirationTimeInMinutes());
    }

    /**
     * Generate Identifier Hash
     *
     * @param $array
     * @return string|null
     */
    public static function generateIdentifierHash($array): ?string
    {
        return Hash::make(json_encode($array));
    }

    /**
     * Convert to boolean
     *
     * @param $boolean
     * @return boolean
     */
    public static function toBoolean($boolean): bool
    {
        return filter_var($boolean, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    }

     /**
     * Generate Invoice Number
     *
     * @param $lastOrderId
     * @param $addOrRemovePrefix
     * @return string
     */
    public static function getLatestOrderCode($lastOrderId, $addOrRemovePrefix): string
    {
        // Determine the offset to remove the prefix
        $offset = strlen($addOrRemovePrefix);

        // Set the numeric part based on whether lastOrderId is null or not
        $numericPart = ($lastOrderId === null) ? '0000000' : substr($lastOrderId, $offset);

        // Convert the numeric part to an integer and increment
        $incrementedValue = intval($numericPart) + 1;

        // Format the incremented value back to the original padding length
        return sprintf("%s%07d", $addOrRemovePrefix, $incrementedValue);
    }

     /**
     * Generate Invoice Number
     *
     * @param $lastOrderId
     * @param $addOrRemovePrefix
     * @return string
     */
    public static function generateInvoiceNumber($lastInvoiceId, $addOrRemovePrefix): string
    {
        // Determine the offset to remove the prefix
        $offset = strlen($addOrRemovePrefix);

        // Set the numeric part based on whether lastOrderId is null or not
        $numericPart = ($lastInvoiceId === null) ? '0000000' : substr($lastInvoiceId, $offset);

        // Convert the numeric part to an integer and increment
        $incrementedValue = intval($numericPart) + 1;

        // Format the incremented value back to the original padding length
        return sprintf("%s%07d", $addOrRemovePrefix, $incrementedValue);
    }
}
