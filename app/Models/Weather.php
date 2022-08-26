<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model

{

    /**
     * @var string
     */

    protected $table = 'user_weather';

    /**
     * @var array
     */

    protected $fillable = ['id','city','temperature','ip'];

}
