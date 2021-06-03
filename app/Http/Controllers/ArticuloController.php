<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articulos = Articulo::latest()->paginate(5);
        return view('articulos.index', compact('articulos'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articulos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'  => 'required',
            'descripcion'  => 'required',
            'precio' => 'required',
            'cantidad'   => 'required|integer',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->except(['_token']);

        if ($imagen = $request->file('imagen')) {
            $destinationPath = 'imagen/';
            $profileImage = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($destinationPath, $profileImage);
            $input['imagen'] = "$profileImage";
        }

        Articulo::create($input);

        return redirect()->route('articulos.index')
            ->with('success','¡Artículo creado satisfactoriamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articulo = Articulo::find($id);
        return view('articulos.edit', compact('articulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre'  => 'required',
            'descripcion'  => 'required',
            'precio' => 'required',
            'cantidad'   => 'required|integer',
        ]);

        $articulo = $request->except(['_token', '_method']);

        if ($imagen = $request->file('imagen')) {
            $destinationPath = 'imagen/';
            $profileImage = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($destinationPath, $profileImage);
            $articulo['imagen'] = "$profileImage";
        }else{
            unset($articulo['imagen']);
        }

        $articulo['nombre'] = $request->get('nombre');
        $articulo['descripcion'] = $request->get('descripcion');
        $articulo['precio'] = $request->get('precio');
        $articulo['cantidad'] = $request->get('cantidad');

        Articulo::where('id', $id)->update($articulo);

        return redirect()->route('articulos.index')
            ->with('success', '¡El artículo ha sido modificado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $articulo = Articulo::find($id);
        $articulo->delete();
        return redirect('articulos.index')->with('success', 'El artículo ha sido eliminado');
    }

    public function add(Request $request){
        \Cart::add(array(
            'id' => $request->id,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'cantidad' => $request->cantidad,
            'attributes' => array(
                'imagen' => $request->imagen,
            )
        ));
        return redirect()->route('articulos.cart')->with('success', '¡Artículo añadido al carrtio!');
    }

    public function remove(Request $request){
        \Cart::remove($request->id);
        return redirect()->route('articulos.cart')->with('success', '¡Artículo retirado del carrito!');
    }

    public function actualizar(Request $request){
        \Cart::update($request->id,
            array(
                'cantidad' => array(
                    'relative' => false,
                    'value' => $request->cantidad
                ),
            ));
        return redirect()->route('articulos.cart')->with('success', '¡Carrito actualizado!');
    }

    public function clear(){
        \Cart::clear();
        return redirect()->route('articulos.index')->with('success', 'Carrito limpiado');
    }
}
