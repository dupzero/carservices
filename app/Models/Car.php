<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['client_id', 'type', 'registered', 'ownbrand', 'accidents'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function latestService()
    {
        return $this->hasOne(Service::class)->orderByDesc('log_number');
    }

    public function serviceLogs()
    {
        return $this->hasMany(Service::class);
    }
}
