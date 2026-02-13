<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Brand; // Import the Brand model


class BrandController extends Controller
{
    //
    public function index()
    {   
        $brands= Brand::orderBy('id', 'DESC')->get();
      
        return view('_admin.brands.list.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('_admin.brands.create.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
           /*  'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg,mp3,pdf|max:2048', */
            'description' => 'nullable|string|max:1000',
            'date' => 'nullable|date',
        ]);

        // Diretórios
       /*  $uploadPath = public_path('uploads');

        if ($request->hasFile('image')) {
            $fileName = time() . '_image.' . $request->image->getClientOriginalExtension();
            $request->image->move($uploadPath . '/brand/brand_logo', $fileName);
            $validated['image'] = $fileName;
        }
 */
        Brand::create($validated);

        return redirect()->route('brands.index')->with('success', 'Marca criada com sucesso!');
        return redirect()->back()->with('error', 'Erro ao criar a marca. Tente novamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        $brand = Brand::findOrFail($brand->id);
        return view('_admin.brands.details.index', compact('brand')); // Caminho diferente para view única
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 public function edit(Brand $brand)
    {
        //
        return view('_admin.brands.edit.index', ['brand' => $brand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  public function update(Request $request, Brand $brand)
{
    $validated = $request->validate([
        'name'        => 'required|string|max:255',
        /* 'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048', */ // removi mp3,pdf – não são imagens
        'description' => 'nullable|string|max:1000',
        'date'        => 'nullable|date',
    ]);

    $uploadPath = public_path('uploads/brand/brand_logo');

    // Só processa a imagem se uma nova foi enviada
 /*    if ($request->hasFile('image')) {
        // (Opcional) Apagar a imagem antiga para não acumular arquivos
        if ($brand->image && file_exists($uploadPath . '/' . $brand->image)) {
            unlink($uploadPath . '/' . $brand->image);
        }

        $fileName = time() . '_' . $request->image->getClientOriginalName();
        // ou use: $fileName = $request->image->hashName(); para nome único seguro

        $request->image->move($uploadPath, $fileName);

        $validated['image'] = $fileName;
    } */
    // Se não enviou nova imagem, mantém a antiga (não toca no campo)

    // Atualiza usando apenas os dados validados
    $brand->update($validated);

    return redirect()->route('brands.index')->with('success', 'Marca atualizada com sucesso!');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
        $brand->delete();

        return redirect()->route('brands.index')->with('success', 'Marca removida com sucesso!');
        return redirect()->back()->with('error', 'Erro ao remover a marca. Tente novamente.');
        //

    }
}
