<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 */
class CustomUsers extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user', 'firstName', 'secondName', 'lastName', 'secondLastname', 'idDeparture', 'idBusinessPosition'];
    protected $dates = ['deleted_at'];

    public const VALIDATIONS = [
        'user'=>'required|min:4|max:100',
        'firstName'=>'required|min:10|max:30',
        'secondName'=>'nullable|max:30',
        'lastName'=>'required|min:10|max:30',
        'secondLastname'=>'nullable|max:30',
        'idDeparture'=>'nullable|max:30',
        'idBusinessPosition'=>'nullable|max:30',
        ];
}
