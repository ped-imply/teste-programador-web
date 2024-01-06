<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendasModell extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='vendas';

    protected $fillable = [
        'data',
        'cep',
        'uf',
        'cidade',
        'bairro',
        'endereco',
        'numero',
        'complemento',
    ];

    protected $cast = [
        'data' => 'date',
    ];

    protected $dates = [
        'data',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->data = date("Y-m-d");
        });
    }

    public function produtos(){
        return $this->BelongsToMany(ProdutosModell::class, 'vendas_has_produtos', 'venda_id', 'produto_id')->withPivot(['valor']);
    }
}
