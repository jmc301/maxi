<?php
   
namespace App\Http\Controllers;
   
use App\User;
use Illuminate\Http\Request;
use Redirect;
use PDF;
use App\Cliente;
   
class GerarPDFController extends Controller
{
   
    public function pdf(){
      
     $data['clientes'] =  Cliente::get();
 
     $pdf = PDF::loadView('posicao.index', $data);
   
     return $pdf->download('arquivo.pdf');
    }
    
 
}