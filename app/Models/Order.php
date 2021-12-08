<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory;

    protected $table="orders";

    protected $fillable = [
        'order_date', 'item', 'type' , 'quantity' , 'driver_id' ,'status'
    ];

    protected $appends = ['status_name'];

    public $timestamps = false;

    public function driver(){
       return $this->belongsTo('App\Models\Driver');
    }

    /**
     * Get active status label for this model.
     *
     * @return string
     */
    public function getStatusNameAttribute()
    {
        return $this->status == '1' ? 'تم الإستلام' : 'تم الايقاف';
    }

}

