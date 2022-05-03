<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChannelMember extends Model
{
    protected $table = 'channelmember';
	protected $primaryKey = 'id';
	public $timestamps = false;
}
