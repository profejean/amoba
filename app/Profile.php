<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;
    
    protected $table = 'profile';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'user_id','ima_profile','created_at'
    ];

}
