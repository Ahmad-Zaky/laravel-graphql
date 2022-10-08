<?php

namespace App\Traits;

trait Dateable {

    public function getCreatedAtAttribute()
    {
        $createdAt = isset($this->attributes['created_at']) 
            ? (new \Carbon\Carbon($this->attributes['created_at']))
                ->format(config('app.date_format') ?? 'd M Y h:i a')
            : null;

        return $createdAt;
    }
    
    public function getUpdatedAtAttribute()
    {
        $updatedAt = isset($this->attributes['updated_at']) 
            ? (new \Carbon\Carbon($this->attributes['updated_at']))
                ->format(config('app.date_format') ?? 'd M Y h:i a')
            : null;

        return $updatedAt;
    }
}