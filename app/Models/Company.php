<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Company extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'docto',
        'address',
        'is_active',

    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function departments()
    {
        return $this->hasMany(Department::class);
    }
    public function companiesUsers()
    {
        return $this->hasMany(CompaniesUser::class);
    }
   
}
