<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $table = 'channel';
	protected $primaryKey = 'id';
	public $timestamps = false;
}
