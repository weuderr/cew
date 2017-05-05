<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estoque extends Model
{
	use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $fillable = ['quantidade','custo','produto_id'/*,'fornecedor_id'*/];

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function produto()
    {
        return $this->belongsTo('App\Produto', 'produto_id');
    }

    /**
     * @Relation
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fornecedor()
    {
        // return $this->belongsTo('App\Fornecedor', 'fornecedor_id');
    }
}
