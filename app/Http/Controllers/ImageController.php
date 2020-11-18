<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

use Illuminate\Support\Facades\DB;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function getImageInput(){
        return view('image_input');
    }
    
    public function postImageConfirm(Request $request){
        // public function postImageConfirm(ImageUploadRequest $request){
        // dd($request);
        $post_data = $request->except('imagefile');
        $imagefile = $request->file('imagefile');
    
        $temp_path = $imagefile->store('public/temp');
        $read_temp_path = str_replace('public/', 'storage/', $temp_path); //追加

        $product_name = $post_data['product_name'];
    
        $data = array(
            'temp_path' => $temp_path,
            'read_temp_path' => $read_temp_path, //追加
            'product_name' => $product_name,
        );
        $request->session()->put('data', $data);
    
        return view('image_confirm', compact('data') );
    }
    
    public function getImageComplete(Request $request) {
        $data = $request->session()->get('data');
        $temp_path = $data['temp_path'];
        $read_temp_path = $data['read_temp_path'];
    
        $filename = str_replace('public/temp/', '', $temp_path);
        //ファイル名は$temp_pathから"public/temp/"を除いたもの
        $storage_path = 'public/productimage/'.$filename;
        //画像を保存するパスは"public/productimage/xxx.jpeg"
    
        $request->session()->forget('data');
    
        Storage::move($temp_path, $storage_path);
        //Storageファサードのmoveメソッドで、第一引数->第二引数へファイルを移動
    
        $read_path = str_replace('public/', 'storage/', $storage_path);
        //商品一覧画面から画像を読み込むときのパスはstorage/productimage/xxx.jpeg"
        $product_name = $data['product_name'];
    
        $this->productcontroller->path = $read_path;
        $this->productcontroller->product_name = $product_name;
        $this->productcontroller->save();
        return view('image_complete');
    }
}