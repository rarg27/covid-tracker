<?php


namespace App\Traits;


use Carbon\Carbon;

trait FormattedTimestamp
{
    public function getCreatedAtAttribute($date)
    {
        return $this->formatTimestamp($date);
    }

    public function getUpdatedAtAttribute($date)
    {
        return $this->formatTimestamp($date);
    }

    public function getDeletedAtAttribute($date)
    {
        return $this->formatTimestamp($date);
    }

    private function formatTimestamp($date) : string
    {
        return Carbon::parse($date)->timezone(config('app.timezone'))->format('Y-m-d H:i:s');
    }
}