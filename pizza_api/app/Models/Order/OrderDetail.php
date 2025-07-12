<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';

    protected $primaryKey = 'order_details_id';

    protected $guarded = [];
}
