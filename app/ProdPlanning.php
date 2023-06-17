<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdPlanning extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'bm_prod_planning';

    protected $dates = [
        'planning_schedule',
        'completed_schedule',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'prod_planning_id',
        'customer_code',
        'order_number',
        'customer_po_number',
        'inventory_item_id',
        'item_code',
        'attribute_number_gsm',
        'attribute_number_w',
        'ordered_quantity',
        'planning_schedule',
        'completed_schedule',
        'roll_seq',
        'revise',
        'status',
        'operation_unit',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function cust_prod(){
        return $this->hasOne(Customer::class, 'cust_party_code', 'customer_code');
    }

}
