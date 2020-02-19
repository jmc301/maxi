<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

	class FilmesController extends Controller
	{
		function listarFilmes (Request $request) {
			var_dump($request->query());
			$name = $request->input('nome');
			echo $name ;
			exit();

			$filmes =  [
				'Desenhos',
				'Novelas',
				'Sseriado'
			];

			$html =  "<ul>";
			foreach ($filmes as $key => $filme) {
				$html .= "<li>$filme<li>";
				# code...
			}

		    echo  $html;
		}
	}

	
