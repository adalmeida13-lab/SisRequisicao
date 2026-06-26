<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Department extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'company_id',
        'name',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);

    }public function companiesUsers()
    {
        return $this->hasMany(CompaniesUser::class);
    }
    
    public function requestDetailsOrig()
    {
        return $this->hasMany(RequestDetail::class, 'department_orig_id');
    }
    public function requestDetailsDest()
    {
        return $this->hasMany(RequestDetail::class, 'department_dest_id');
    }
}
