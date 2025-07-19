<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Attendance extends Model
{
    protected $table = 'attendances';

    protected $guarded = [];

    public function getClockInFormattedAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->clock_in)->format('d F y, H:i:s');
    }


    public function getClockOutFormattedAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->clock_out)->format('d F y, H:i:s');
    }
}
