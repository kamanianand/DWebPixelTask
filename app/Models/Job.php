<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'company_jobs';

    protected $fillable = ['id','title','description','experience','salary','location','extra_info','company_name','company_logo'];

    protected $appends = ['full_image_path'];
    
    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    public function getFullImagePathAttribute()
    {
        return url('/storage/images') . '/' . $this->company_logo;
    }
}
