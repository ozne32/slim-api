<?php 
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Produto;

// Rotas para produtos
$app->group('/api/v1', function() {
    $this->get('/produtos/lista', function(Request $request,Response $response){
        $produtos = Produto::get(); //se eu só fizer isso vai dar que não foi conectado, pois precisa que 
        // que eu faça a conexão com o banco de dados utilizando o capsule
        return $response->withJson( $produtos );
    });
    $this->post('/produtos/adiciona', function(Request $request,Response $response){
        $dados = $request->getParsedBody();
        $produto = Produto::create($dados); //se eu só fizer isso vai dar que não foi conectado, pois precisa que 
        // que eu faça a conexão com o banco de dados utilizando o capsule
        return $response->withJson( $produto );
    });
    $this->get('/produtos/lista/{id}', function(Request $request,Response $response, $args){
        $produto_id= Produto::findOrFail($args['id']); //se eu só fizer isso vai dar que não foi conectado, pois precisa que 
        // que eu faça a conexão com o banco de dados utilizando o capsule
        return $response->withJson( $produto_id );
    });
    $this->put('/produtos/atualiza/{id}', function(Request $request,Response $response, $args){
        $produto_id= Produto::findOrFail($args['id']);
        $dados = $request->getParsedBody();
        $produto_id->update($dados);
        return $response->withJson( $produto_id );
    });
    $this->delete('/produtos/remover/{id}', function(Request $request,Response $response, $args){
        $produto_id= Produto::findOrFail($args['id']);
        $produto_id->delete( );
        return $response->withJson( $produto_id );
    });
}); 
