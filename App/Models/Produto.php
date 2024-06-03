<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
// aqui que vai ficar as minhas funções com querys para modificar o banco de dados 
class Produto extends Model{
    protected $fillable= ['titulo','descricao','preco','fabricante','created_at','updated_at'];
}
