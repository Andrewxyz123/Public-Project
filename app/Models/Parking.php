<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    use HasFactory;

    public $timestamps = false;

    // protected $times = [
    //     'park_in',
    //     'park_out'
    //   ];

    //   protected $appends = ['diffInDays'];

    //   public function getDiffInDaysAttribute()
    //   {
    //     if (!empty($this->park_in) && !empty($this->park_out)) {
    //       return $this->updated_at->diffInDays($this->created_at);
    //     }
    //   }

    protected $table = 'parking';

    protected $fillable = [
        'plate_number',
        'code',
        'park_out'
    ];

    

}
