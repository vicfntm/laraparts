<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Court;
use Session;
use Purifier;
use Image;
use Storage;
use Auth;
use App\CourtCategory;

class EditorialCourtController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courts = Court::orderBy('name', 'ASC')->paginate();

        return view('editcourts.index')
            ->withCourts($courts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courtCategories = CourtCategory::orderBy('category', 'ASC')->get();
        return view('editcourts.create')
            ->withCats($courtCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slug_edited = $request->slug ? $request->slug : str_slug($request->name);
        $this->validate($request, array(
            'name' => 'unique:courts,name',
            $slug_edited => 'unique:courts,slug | max:255',
            'description' => 'max:5000',
            'seo_description' => 'max:255',
            'seo_keywords' => 'max:255',
            'image'=> 'sometimes | image',
            'city' => 'required | max:255',
            'courtcover' => 'max:255',
            'courtamount' => 'max:255'
            ));
        $court = new Court;
        $court->name = $request->name;
        $court->city = $request->city;
        $court->address = $request->address;
        $court->courtcover = $request->courtcover;
        $court->courtamount = $request->courtamount;
        $court->description = $request->description;
        $court->contacts = $request->contacts;
        $court->website = $request->website;
        $court->slug = $slug_edited;
        $court->seo_description = $request->seo_description;
        $court->seo_keywords = $request->seo_keywords;
        $court->courtcategory_id = $request->courtcategory_id;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path() . '/src/img/' . $filename;
            $thumb_location = public_path() . '/src/img/' . 'thumb_' . $filename;
            Image::make($image)->save($location);
            Image::make($image)->fit(360,250)->save($thumb_location);
            $court->image = $filename;
        };
        $court->save();
        Session::flash('success', 'Запись успешно сохранена');
        return redirect()->route('editcourts.show', $court->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $court = Court::find($id);

        return view('editcourts.show')
            ->withCourt($court);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $court = Court::find($id);
        $cats = CourtCategory::all();
        $categories = array();
        foreach ($cats as $cat) {
            $categories[$cat->id] = $cat->category;
        };
        return view('editcourts.edit')
            ->withCourt($court)
            ->withCategories($categories);
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
        $slug_edited = $request->slug ? $request->slug : str_slug($request->name);
        $court = Court::find($id);
        if($slug_edited == $court->slug and $request->name==$court->name) {
            $this->validate($request, array(
                'description' => 'max:5000',
                'seo_description' => 'max:255',
                'seo_keywords' => 'max:255',
                'image'=> 'sometimes | image',
                'city' => 'required | max:255',
                'courtcover' => 'max:255',
                'courtamount' => 'max:255'
            ));
        }else if($slug_edited == $court->slug and $request->name!=$court->name){
            $this->validate($request, array(
                'name' => 'unique:courts,name',
                'description' => 'max:5000',
                'seo_description' => 'max:255',
                'seo_keywords' => 'max:255',
                'image'=> 'sometimes | image',
                'city' => 'required | max:255',
                'courtcover' => 'max:255',
                'courtamount' => 'max:255'
            ));
        }else if($slug_edited != $court->slug and $request->name==$court->name){
            $this->validate($request, array(
                $slug_edited => 'unique:courts,slug | max:255',
                'description' => 'max:5000',
                'seo_description' => 'max:255',
                'seo_keywords' => 'max:255',
                'image'=> 'sometimes | image',
                'city' => 'required | max:255',
                'courtcover' => 'max:255',
                'courtamount' => 'max:255'
            ));
        }else{
                $this->validate($request, array(
                $slug_edited => 'unique:courts,slug | max:255',
                'name' => 'unique:courts,name',
                'description' => 'max:5000',
                'seo_description' => 'max:255',
                'seo_keywords' => 'max:255',
                'image'=> 'sometimes | image',
                'city' => 'required | max:255',
                'courtcover' => 'max:255',
                'courtamount' => 'max:255'
            ));
        };
        $court->name = $request->name;
        $court->city = $request->city;
        $court->address = $request->address;
        $court->courtcover = $request->courtcover;
        $court->courtamount = $request->courtamount;
        $court->description = $request->description;
        $court->contacts = $request->contacts;
        $court->website = $request->website;
        $court->slug = $slug_edited;
        $court->seo_description = $request->seo_description;
        $court->seo_keywords = $request->seo_keywords;
        $court->courtcategory_id = $request->courtcategory_id;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path() . '/src/img/' . $filename;
            $thumb_location = public_path() .'/src/img/' . 'thumb_' . $filename;
            Image::make($image)->save($location);
            Image::make($image)->fit(360,250)->save($thumb_location);            
            $oldFileName = $court->image;
            $court->image = $filename;
            Storage::delete($oldFileName);
            Storage::delete('thumb_' . $oldFileName);
        };
            $court->save();
            Session::flash('success', 'Изменения успешно сохранены!');
            return redirect()->route('editcourts.show', $court->id);
    }

    public function delete($id){
        $court = Court::find($id);
        return view('editcourts.delete')
            ->withCourt($court);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $court = Court::find($id);
        Storage::delete($court->image);
        Storage::delete('thumb_' . $court->image);
        $court->delete();
        Session::flash('success', 'Корт был успешно удален!');

        return redirect()->route('editcourts.index');
    }


}
