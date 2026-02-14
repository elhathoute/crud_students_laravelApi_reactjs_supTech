<?php
namespace App\Models;
use App\Models\Branch;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'gender', 'address', 'birthDate', 'bacGrade', 'idBranch', 'image'];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'idBranch', 'id');
    }
}



