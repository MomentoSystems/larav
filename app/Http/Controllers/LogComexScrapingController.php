<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;


class LogComexScrapingController extends Controller
{
   
    /*
    Ira guardar os dados capturados das colunas : codigo , numero , casas decimais , nome da moeda , locais em circulacao

    */
    private $dados_moeda=[];

    public function index()
    {

      
    $client = new Client();
    
    $website = $client->request('GET', 'https://pt.wikipedia.org/wiki/ISO_4217');
    
    $valor=($website->filter('.wikitable')->eq(0));

    $teste=$valor->each(function ($node) {
        
        $linhas=($node->filter('tbody')->children('tr'));

        //echo $linhas->count();182
        $linha=0;

        $teste1=$linhas->each(function ($node1,$linha) {

            $linha++;

            $linha2=($node1->filter('tr')->children('td'));

            $soma=0;$moeda=[];

            $moedas_colunas=$linha2->each(function ($node2,$soma) {

                $soma++;
                
                $a=false;
                switch($soma){

                 case '1':return array("moeda"=>$node2->text());break;
                 case '2':return array("numero"=>$node2->text());break;
                 case '3':return array("casas_decimais"=>$node2->text());break;
                 case '4':return array("nome_moeda"=>$node2->text());break;
                 case '5':return array("locais"=>$node2->text());break;


                }

            });

            if($linha!=1){

                array_push($moeda,$moedas_colunas);

                if (array_key_exists('locais', @$moedas_colunas[4])) { 

                
                }

           
            }




        });

    });
    
    }


    private function buscador($nome_moeda){

        


    }




}
