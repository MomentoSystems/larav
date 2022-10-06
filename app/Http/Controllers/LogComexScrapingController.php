<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;


class LogComexScrapingController extends Controller
{

    public $codigo;

    public function index(Request $request)
    {

        $dados_enviado=json_decode($request->getContent(), true);

        $this->codigo=($dados_enviado['code']);

        
      
    $client = new Client();
    
    $website = $client->request('GET', 'https://pt.wikipedia.org/wiki/ISO_4217');
    
    $valor=($website->filter('.wikitable')->eq(0));

    $teste=$valor->each(function ($node) {
        
        $linhas=($node->filter('tbody')->children('tr'));

        
        $linha=0;

        $teste1=$linhas->each(function ($node1,$linha) {

            $linha++;

            $linha2=($node1->filter('tr')->children('td'));

            $soma=0;$moeda=[];

            $moedas_colunas=$linha2->each(function ($node2,$soma) {

                $soma++;
                
                
                switch($soma){

                 case '1':return array("moeda"=>$node2->text());break;
                 case '2':return array("numero"=>$node2->text());break;
                 case '3':return array("casas_decimais"=>$node2->text());break;
                 case '4':return array("nome_moeda"=>$node2->text());break;
                 case '5':
                    
                    
                    $contagem_fotos=$node2->filter('img')->count();

                    for($i=0;$i<$contagem_fotos;$i++){

                        $img[]=$node2->filter('img')->eq($i)->attr('src');

                    }

                    return array("locais"=>$node2->text(),"img"=>@$img);



                }

            });


            if($linha!=1){

                array_push($moeda,$moedas_colunas);

                if (array_key_exists('locais', @$moedas_colunas[4])) { 


                    $locais=preg_split('/(,)/', $moedas_colunas[4]['locais']);

                    $wLocation=[];
                   

                    foreach($locais as $chave=>$location){

                          @$q=array("location"=>trim($location),"icon"=>$moedas_colunas[4]['img'][$chave]);

                          array_push($wLocation,$q);

                    }

                   $formata_saida=array(

                      "code"=>$moedas_colunas[0]['moeda'],
                      "number"=>$moedas_colunas[1]['numero'],
                      "decimal"=>$moedas_colunas[2]['casas_decimais'],
                      "currency"=>$moedas_colunas[3]['nome_moeda'],
                      "currency_locations"=>$wLocation

                   );


                   if($this->codigo==$moedas_colunas[0]['moeda']){


                   $content= (json_encode($formata_saida));

                   echo $content;

                   }

                }

           
            }




        });

    });
    
    }

}
