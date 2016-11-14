<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public $table = "notes";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
                'id',
        'title',
        'body',

    ];

    public static $rules = [
        // create rules
    ];

    
    public function user() {
        return $this->belongsTo(App\Models\User::class);
    }

}
