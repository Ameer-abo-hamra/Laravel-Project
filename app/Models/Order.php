<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ["pharmacist_id", "price", "state", "payed", "isStateModified"];

    protected $hidden = ['created_at', "updated_at", "id"];

    public function pharmacist()
    {

        return $this->belongsTo(Pharmacist::class, 'pharmacist_id');


    }

    public function medicines()
    {

        return $this->belongsToMany(Medicine::class,"_order__medicine");

    }

}
