<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'cliente';

    protected $fillable = ['nombre', 'dato_id', 'image'];
	
	public function dato(){
        return $this->belongsTo('App\Models\Dato', 'id');
    }
}