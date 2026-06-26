<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompaniesUser extends Model
{
    protected $table = 'companies_users';

    protected $fillable = [
        'company_id',
        'user_id',
        'department_id',
        'role',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
