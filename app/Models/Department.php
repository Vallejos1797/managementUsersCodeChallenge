<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Department extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['code', 'name', 'active', 'createdByUserId'];

    public function users()
    {
        return $this->hasMany(CustomUser::class, 'idDepartment');
    }
}
