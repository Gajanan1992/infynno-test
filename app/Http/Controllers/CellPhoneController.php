<?php

namespace App\Http\Controllers;

use App\Models\CellPhone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CellPhoneController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phones = CellPhone::with(['owner'])->paginate(5);

        return view('cell-phones.index', compact('phones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cell-phones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
            'brand_name'=>'required',
            'model_name'=> 'required',
            'image'=> 'nullable|image|mimes:png,jpg',
            'price'=> 'required|numeric',
            'ram_capacity'=>'nullable|numeric',
            'rom_capacity'=>'nullable|numeric',
            'primary_camera'=>'nullable|numeric',
            'secondary_camera'=> 'nullable|numeric',
            'screen_size'=> 'nullable|numeric',
        ]);

        $userId = Auth::user()->id;
        $imageUrl = null;

        if ($request->hasFile('image')) {
            $img = $request->image;
            $filename = $img->getClientOriginalName();
            $imageUrl = Storage::putFileAs('/public/images', $request->file('image'), $filename);
        }

        $phone = CellPhone::create([
            'brand_name'=> $request->brand_name,
            'model_name'=> $request->model_name,
            'price'=> $request->price,
            'image' => $imageUrl ?? null,
            'ram_capacity'=> $request->ram_capacity,
            'rom_capacity'=> $request->rom_capacity,
            'primary_camera'=> $request->primary_camera,
            'secondary_camera'=> $request->secondary_camera,
            'screen_size'=> $request->screen_size,
            'created_by'=> $userId,
        ]);

        return redirect()->route('cellphone.index')->with('msg', 'New Cell Phone added to the inventory.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CellPhone  $cellPhone
     * @return \Illuminate\Http\Response
     */
    public function show(CellPhone $cellPhone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CellPhone  $cellPhone
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cellPhone = CellPhone::findOrFail($id);

        return view('cell-phones.edit', compact('cellPhone'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CellPhone  $cellPhone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $attributes = $this->validate($request, [
            'brand_name'=>'required',
            'model_name'=> 'required',
            'image'=> 'nullable|image|mimes:png,jpg',
            'price'=> 'required|numeric',
            'ram_capacity'=>'nullable|numeric',
            'rom_capacity'=>'nullable|numeric',
            'primary_camera'=>'nullable|numeric',
            'secondary_camera'=> 'nullable|numeric',
            'screen_size'=> 'nullable|numeric',
        ]);

        $userId = Auth::user()->id;

        $cellPhone = CellPhone::findOrFail($id);

        $imageUrl = null;
        if ($request->hasFile('image')) {
            $img = $request->image;
            $filename = $img->getClientOriginalName();
            $imageUrl = Storage::putFileAs('/public/images', $request->file('image'), $filename);
        }

        $cellPhone->update([
            'brand_name'=> $request->brand_name,
            'model_name'=> $request->model_name,
            'image'=> $imageUrl,
            'price'=> $request->price,
            'ram_capacity'=> $request->ram_capacity,
            'rom_capacity'=> $request->rom_capacity,
            'primary_camera'=> $request->primary_camera,
            'secondary_camera'=> $request->secondary_camera,
            'screen_size'=> $request->screen_size,
            'updated_by'=> $userId,
        ]);

        return redirect()->route('cellphone.index')->with('msg', 'Cell phone updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CellPhone  $cellPhone
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cellPhone = CellPhone::findOrFail($id);

        Storage::delete($cellPhone->image);

        $cellPhone->delete();

        return back()->with('msg', 'Cell phone record deleted.');
    }

    public function search(Request $request){
        $term = $request->term;

        $suggetions = CellPhone::select('id','brand_name')->where('brand_name', 'like', '%'.$term.'%')->get();

        return response(['suggetions' => $suggetions]);

    }

    public function searchResult(Request $request){
        $term = $request->term;

        $phones = CellPhone::with(['owner'])->where('brand_name', 'like', '%'.$term.'%')->paginate(5);

        return view('cell-phones.search-result', compact('phones'));

    }

}
