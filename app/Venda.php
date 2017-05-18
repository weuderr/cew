<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venda extends Model
{
	use SoftDeletes;

    /**
     * The database table vendas by the model.
     *
     * @var string
     */
    protected $table = 'vendas';

    /**
     * The database table primary key.
     *
     * @var string
     */
    // protected $primaryKey = 'user_id';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $fillable = ['nome_vendedor','venda_item_id','desconto','total','cancelada'];

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
    // protected $keyType = 'json';
    /**
     * @Relation
     * @todo RELACIONAR COM O VENDA_ITEM_ID
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendaItem()
    {
    	return $this->belongsTo('App\VendaItem','venda_item_id');
    }
}
