<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = ["s_name", "t_name", "category", "company", "amount", "end_date", "price"];

    protected $hidden = ["created_at", "updated_at", "id",];

    public function orders()
    {
        return $this->belongsToMany(Order::class, "_order__medicine");
    }

    public function pharmacists() {
        return $this->belongsToMany(Pharmacist::class , "med_phar");
    }

}
