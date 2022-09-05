<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\DB;
use App\Models\Size;
use Illuminate\Support\Facades\App;

class ResizeController extends Controller
{
    
    public function index()
    {
    	return view('example');
    }
    
    public function indexSize() {
        // $size = DB::table('sizes')->select('width_single', 'height_single', 'width_list', 'height_list')->get();
        // $sizes = Size::all();
        // dd(1);
        $sizes = DB::table('sizes')->get();
        return view('users.panel', compact('sizes'));
    }

    
    public function store(Request $request) {
    
        $this->validate($request, [
            'widthlist' => 'required|digits_between:1,4',
            'heightlist' => 'required|digits_between:1,4',
            'widthsng' => 'required|digits_between:1,4',
            'heightsng' => 'required|digits_between:1,4',
        ]);

        // $insert = [
        //     'width_single' => $request->input('widthsng'),
        //     'height_single' => $request->input('heightsng'),
        //     'width_list' => $request->input('widthlist'),
        //     'height_list' => $request->input('heightlist'),
        //     'updated_at' => now(),
        // ];
        // Size::insertGetId($insert);
        $size=Size::where('id', 1)->update([
            'width_single' => $request->input('widthsng'),
            'height_single' => $request->input('heightsng'),
            'width_list' => $request->input('widthlist'),
            'height_list' => $request->input('heightlist'),
            'updated_at' => now(),
        ]);


        return redirect('/users')->with('success', 'Changes related to dimensions were changed succesfully!');
    }

    public function resizeImage(Request $request)
    { 
        $size=Size::where('id', 1)->first();
        $this->validate($request, [
            'file' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:5120',
        ]);
        $image = $request->file('file');
        $input['file'] = time().'.'.$image->getClientOriginalExtension();
        
        $destinationPath = public_path('/thumbnail');
        $imgFile = Image::make($image->getRealPath());
        $imgFile->resize($size->width_list, $size->height_list, function ($constraint) {
		    $constraint->aspectRatio();
		})->save($destinationPath.'/'.$input['file']);
        $destinationPath = public_path('/uploads');
        $image->move($destinationPath, $input['file']);
        return back()->with('success','Image has successfully been uploaded.')->with('fileName', $input['file']);
    }
}