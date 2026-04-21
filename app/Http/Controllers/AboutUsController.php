<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        $aboutus=AboutUs::all();
        return view('admin.aboutus.index',compact('aboutus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('admin.aboutus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    $this->validate($request, [
        
        'description' => 'string|required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        
    ]);

    $data = $request->only(['description']);

  

    if ($request->hasFile('image') && $request->file('image')->isValid()) {
        $image = $request->file('image');

        $uploadDirectory = public_path('uploads/aboutus');
        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        $imagePath = $image->move($uploadDirectory, $image->getClientOriginalName());
        $data['image'] = 'uploads/aboutus/' . $image->getClientOriginalName();
    }

    $status = AboutUs::create($data);

    if ($status) {
        request()->session()->flash('success', 'About Us successfully added');
    } else {
        request()->session()->flash('error', 'Error occurred, Please try again!');
    }

    return redirect()->route('aboutus.index');
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
      
        $category=AboutUs::findOrFail($id);
        return view('admin.aboutus.edit')->with('category',$category);
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
        $aboutus = AboutUs::findOrFail($id);
    
        $request->validate([
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $data = $request->only(['description']);
    
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $uploadPath = public_path('uploads/aboutus');
    
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
    
            // Delete old image
            if ($aboutus->image && file_exists(public_path($aboutus->image))) {
                unlink(public_path($aboutus->image));
            }
    
            $filename = $image->getClientOriginalName();
            $image->move($uploadPath, $filename);
            $data['image'] = 'uploads/aboutus/' . $filename;
        }
    
        $aboutus->update($data);
    
        return redirect()->route('aboutus.index')->with('success', 'About Us updated successfully.');
    }
    

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aboutus = AboutUs::findOrFail($id);
    
        // Delete image file if it exists
        if ($aboutus->image && file_exists(public_path($aboutus->image))) {
            unlink(public_path($aboutus->image));
        }
    
        $status = $aboutus->delete();
    
        if ($status) {
            request()->session()->flash('success', 'About Us entry successfully deleted');
        } else {
            request()->session()->flash('error', 'Error while deleting About Us entry');
        }
    
        return redirect()->route('aboutus.index');
    }
    

   
}