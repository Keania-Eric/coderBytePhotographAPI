<?php

namespace App\Models;

use App\Models\User;
use App\Traits\ReferenceGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PhotoshootRequest extends Model
{
    use HasFactory, ReferenceGenerator;
    
    protected $guarded = [];

    protected $refPrefix = 'PSR-';
    
    /**
     * Sets the reference prop whenever the creating event is being fired
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
     * A collection of photoshots made for just this request
     *
     * @return \Illuminate\Support\Collection
     */
    public function photoshoots()
    {
        return $this->belongsTo(Photoshoot::class, 'request_id');
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
