<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approvals extends Model
{
    use HasFactory;
    protected $table = 'approvals';
    protected $primaryKey = 'id';
    protected $fillable = [
        'expenses_id',
        'approver_id',
        'status_id',
    ];

    public function expenses()
    {
        return $this->belongsTo(Expenses::class,'expenses_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class,'approver_id');
    }

    public function status()
    {
        return $this->belongsTo(Statuses::class,'status_id');
    }
}
