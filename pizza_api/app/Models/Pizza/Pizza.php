<?php

namespace App\Models\Pizza;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    protected $table = 'pizzas';

    protected $primaryKey = 'pizza_id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];
}
