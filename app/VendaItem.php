<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendaItem extends Model
{
	use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $fillable = ['estoque_id','quantidade','valor','sub_total','troca','cancelada'];

    /**
     * 
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    	'deleted_at',
        'updated_at',
        'created_at',
        'created_by',
        'deleted_by',
        'updated_by'
    ];

    /**
     * @Relation
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estoque()
    {
    	return $this->belongsTo('App\Estoque', 'estoque_id');
    }
}
