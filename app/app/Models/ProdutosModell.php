<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdutosModell extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'produtos';

    protected $fillable = [
       'nome',
       'referencia',
       'preco',

    ];

    public function fornecedores(){
        return $this->BelongsToMany(FornecedoresModell::class, 'fornecedores_has_produtos', 'produto_id', 'fornecedor_id');
    }
}
