<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'alamat', 'status', 'file1', 'sales_id', 'activator_id'];

    public function sales()
    {
        return $this->belongsTo(User::class, 'sales_id');
    }

    public function activator()
    {
        return $this->belongsTo(User::class, 'activator_id');
    }
}
