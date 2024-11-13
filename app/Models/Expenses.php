<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;
    protected $table = 'expenses';
    protected $primaryKey = 'id';
    protected $fillable = [
        'description',
        'amount',
        'status_id',
    ];

    public function status()
    {
        return $this->belongsTo(Statuses::class,'status_id');
    }

    public function approvals()
    {
        return $this->hasMany(Approvals::class);
    }
}
