@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="">
                    @csrf

                    氏名
                    <input type="text" name="your_name" value="{{ $contact->your_name}}">
                    <br>
                    件名
                    <input type="text" name="title" value="{{ $contact->title}}">
                    <br>
                    メールアドレス
                    <input type="email" name="email" value="{{ $contact->email}}">
                    <br>
                    ホームページ
                    <input type="url" name="url" value="{{ $contact->url}}">
                    <br>
                    性別
                    <input type="radio" name="gender" value="0" @if($contact->gender === 0) cheched @endif>男性</input>
                    <input type="radio" name="gender" value="1" @if($contact->gender === 1) cheched @endif>女性</input>
                    <br>
                    年齢
                    <select name="age">
                    <option value="">選択してください</option>
                    <option value="1">~19歳</option>
                    <option value="2">20歳~29歳</option>
                    <option value="3">30歳~39歳</option>
                    <option value="4">40~49歳</option>
                    <option value="5">50~59歳</option>
                    <option value="6">60歳~</option>
                    </select>
                    <br>
                    お問い合わせ内容
                    <textarea name="contact">{{ $contact->contact}}</textarea>
                    <br>
                    
                    <input type="checkbox" name="caution" value="1">注意事項に同意する
                    <br>
                    
                    <input class="btn btn-info" type="submit" value="更新する">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
