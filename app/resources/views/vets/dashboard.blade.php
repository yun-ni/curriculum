@extends('layouts.layout')
@section('content')
<!-- エラー表示 -->
@if (session('message'))
<div class="alert alert-success text-center">
    {{ session('message') }}
</div>
@endif
<!-- フォーム -->
<div class="container bg-secondary-subtle">
    <div class="row justify-content-center">
        <!-- 左側 -->
        <div class="col-5 bg-success-subtle">
            <p class="text-center">検索</p>
            <form>
                <label for="email" class="ml-2 mt-1 mb-0">メールアドレス</label>
                <input type='email' class='form-control' name='email' value="{{ old('email') }}"/>

                <label for="name" class="ml-2 mt-1 mb-0">飼い主の名前</label>
                <input type='text' class='form-control' name='name' value="{{ old('name') }}"/>

                <label for="name" class="ml-2 mt-1 mb-0">ペットの名前</label>
                <input type='text' class='form-control' name='pet_name'value="{{ old('pet_name') }}"/>

                <label for="birth_date" class="ml-1 mt-2 mb-0">誕生日</label>
                <input type='date' class='form-control' name='birth_date' id='birth_date' value="{{ old('birth_date') }}"/>

                <div class='row justify-content-center'>
                    <button type='submit' class='btn btn-primary w-25 mt-2 mb-3'>検索</button>
                </div>
            </form>
        </div>
        <!-- 右側 -->
        <div class="col-7 bg-danger-subtle">
            <p class="text-center">飼い主 一覧</p>
            <div class="card-body">
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th scope="col">飼い主</th>
                            <th scope="col">ペットの一覧</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>
                                <a href="{{ route('vet.show', ['id' => $user->id]) }}">#</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection