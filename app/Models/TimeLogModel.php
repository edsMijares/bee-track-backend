<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeLogModel extends Model
{
    protected $table = 'time_logs';

    protected $fillable = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }
}
