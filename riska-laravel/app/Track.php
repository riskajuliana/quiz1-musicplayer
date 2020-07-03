<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $fillable = ['track_name', 'album_id', 'track_time', 'track_file'];
}
