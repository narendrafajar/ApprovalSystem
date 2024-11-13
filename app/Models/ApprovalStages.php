<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalStages extends Model
{
    use HasFactory;
    protected $table = 'approval_stages';
    protected $primaryKey = 'id';
    protected $fillable = [
        'approver_id'
    ];

    public function approver()
    {
        return $this->belongsTo(User::class,'approver_id');
    }
}