<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeSlider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        $query = HomeSlider::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($builder) use ($search) {
                $builder->where('top_title', 'like', "%$search%");
            });
        }

        $sliders = $query->latest()->paginate(5);

        return view('sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('sliders.create');
    }

    public function store(Request $request)
    {
        // Validación de los campos
        $request->validate([
            'top_title' => 'required',
            'title' => 'required',
            'sub_title' => 'required',
            'offer' => 'required',
            'link' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:0,1',
        ]);

        // Procesar y guardar la imagen en la carpeta 'slider'
        $imageName = time() . '.' . $request->image->extension();
        $request->image->storeAs('slider', $imageName);

        // Crear nueva instancia de Slider
        $slider = new HomeSlider([
            'top_title' => $request->input('top_title'),
            'title' => $request->input('title'),
            'sub_title' => $request->input('sub_title'),
            'offer' => $request->input('offer'),
            'link' => $request->input('link'),
            'image' => $imageName,
            'status' => $request->input('status'),
        ]);

        // Guardar el slider en la base de datos
        $slider->save();

        return redirect()->route('sliders.index')->with('success', 'Slider agregado exitosamente');
    }

    public function show($id)
    {
        $slider = HomeSlider::findOrFail($id);
        return view('sliders.show', compact('slider'));
    }

    public function edit($id)
    {
        // Obtener el slider por ID
        $slider = HomeSlider::findOrFail($id);

        // Retornar la vista de edición con el slider
        return view('sliders.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        // Validación de los campos
        $request->validate([
            'top_title' => 'required',
            'title' => 'required',
            'sub_title' => 'required',
            'offer' => 'required',
            'link' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:0,1',
        ]);

        // Obtener el slider por ID
        $slider = HomeSlider::findOrFail($id);

        // Actualizar los campos
        $slider->top_title = $request->input('top_title');
        $slider->title = $request->input('title');
        $slider->sub_title = $request->input('sub_title');
        $slider->offer = $request->input('offer');
        $slider->link = $request->input('link');
        $slider->status = $request->input('status');

        // Procesar y guardar la nueva imagen si se proporciona
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('slider', $imageName);
            $slider->image = $imageName;
        }

        // Guardar los cambios en la base de datos
        $slider->save();

        // Redireccionar con mensaje de éxito
        return redirect()->route('sliders.index')->with('success', 'Slider actualizado exitosamente');
    }

    public function destroy($id)
    {
        // Encuentra el slider por su ID
        $slider = HomeSlider::findOrFail($id);

        // Elimina la imagen asociada si existe
        if (Storage::exists('slider/' . $slider->image)) {
            Storage::delete('slider/' . $slider->image);
        }

        // Elimina el slider de la base de datos
        $slider->delete();

        return redirect()->route('sliders.index')->with('success', 'Slider eliminado exitosamente');
    }
}
