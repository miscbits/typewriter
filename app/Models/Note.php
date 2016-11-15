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
		'user_id',
		'created_at',
		'updated_at',

    ];

    public static $rules = [
        // create rules
    ];

    // Note 

}
