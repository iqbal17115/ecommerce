<?php

namespace App\Traits;

trait GeneratesOrderCodeTrait
{
    /**
     * Boot function to hook into Eloquent events.
     */
    public static function bootGeneratesOrderCodeTrait()
    {
        static::creating(function ($model) {
            $model->code = $model->generateOrderCode();
        });
    }

    /**
     * Generate a unique order code.
     *
     * @return string
     */
    protected function generateOrderCode()
    {
        return uniqid();
    }
}
