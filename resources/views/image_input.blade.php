@extends('layouts.app')

@section('content')
    <form action="image_confirm" method="post" enctype="multipart/form-data" id="form">
        @csrf
        <p>ファイル：</p>
        <input type="file" name="imagefile" value=""/><br /><br />

        <p>商品名：</p><br />
        <input type="text" name="product_name" size="50" value="{{ old('name') }}"/><br /><br />

        <input type="submit" name="confirm" id="button" value="確認" />
    </form>
@endsection

