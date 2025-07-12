<?php

namespace App\Models\Pizza;

use Illuminate\Database\Eloquent\Model;

class PizzaType extends Model
{
    protected $table = 'pizza_types';

    protected $primaryKey = 'pizza_type_id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];
}
