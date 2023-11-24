<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CustomUser extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'username',
        'email',
        'firstName',
        'secondName',
        'lastName',
        'secondLastName',
        'departmentId',
        'positionId',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'departmentId');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'positionId');
    }
}
