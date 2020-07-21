<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Produto;
use Illuminate\Http\Request;
use Storage;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $produto = Produto::where('descricao', 'LIKE', "%$keyword%")
                ->orWhere('foto', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $produto = Produto::latest()->paginate($perPage);
        }

        return view('produto.index', compact('produto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('produto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $foto = "";
        if ($request->hasfile('foto')) {
            $foto = $request->file('foto')->store('produto');            
        }

        //$request->foto->pathName = $foto;

        $requestData = $request->all();

        Produto::create(['descricao' => $request->descricao, 'foto' => $foto]);
//      Produto::create($requestData);

        return redirect('produto')->with('flash_message', 'Produto adicionado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $produto = Produto::findOrFail($id);

        return view('produto.show', compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $produto = Produto::findOrFail($id);

        return view('produto.edit', compact('produto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $foto = $request->foto;
        if ($request->hasfile('foto')) {
            $foto = $request->file('foto')->store('produto');            
        }
        
        $requestData = $request->all();
        
        $produto = Produto::findOrFail($id);
        $produto->update(['descricao' => $request->descricao, 'foto' => $foto]);
//      $produto->update($requestData);

        return redirect('produto')->with('flash_message', 'Produto alterado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $produto = Produto::find($id);
        $foto = $produto->foto;

        Produto::destroy($id);

        if ($produto->foto) {
            Storage::delete($foto);
        }

        return redirect('produto')->with('flash_message', 'Produto excluído!');
    }
}
