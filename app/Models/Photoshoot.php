<?php

namespace App\Models;

use App\Models\User;
use App\Models\PhotoshootRequest;
use Spatie\MediaLibrary\HasMedia;
use App\Traits\ReferenceGenerator;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photoshoot extends Model implements HasMedia
{
    use HasFactory, ReferenceGenerator, InteractsWithMedia;
    
    protected $guarded = [];

    
    /**
     * Sets the reference code whenever a creating event is fired
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function($model) {
            $model->reference = $model->generateReference();
        });
    }

    
    /**
     * The request for which this photo shoot belongs to
     *
     * @return \Illuminate\Support\Collection
     */
    public function request()
    {
        return $this->belongsTo(PhotoshootRequest::class, 'request_id');
    }

    
    /**
     * The product owner for requested the photoshoot
     *
     * @return \App\Models\User
     */
    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id');
    }
        
    /**
     * The photograher who made the photoshoot
     *
     * @return \App\Models\User
     */
    public function photographer()
    {
        return $this->belongsTo(User::class, 'photographer_id');
    }

}
