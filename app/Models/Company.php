<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\MassAssignmentException;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'website',
        'email',
    ];
    function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
