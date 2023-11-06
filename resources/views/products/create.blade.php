@extends('layouts.app')

@section('content')
    <main class="container">
        <section>
            <form method="post" action="{{route('products.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="titlebar">
                    <h1>Добавить продукт</h1>
                    <button>
                        <a href="{{ url('/') }}">Назад</a>
                    </button>

                </div>
                @if($errors->any())
                    <div>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div>
                        <label>Название</label>
                        <input type="text" name="name">
                        <label>Описание товара</label>
                        <textarea cols="10" rows="5" name="description"></textarea>
                        <label>Добавить изображение</label>
                        <img src="" alt="" class="img-product" id="file-preview"/>
                        <input type="file" name="image" accept="image/*" onchange="showFile(event)">
                    </div>
                    <div>
                        <label>Категория</label>
                        <select name="category">
                            @foreach(json_decode('{"Телефон":"Телефон", "Телевизор":"Телевизор", "Компьютер": "Компьютер"}', true) as $optionKey => $optionValue)
                                <option value="{{$optionKey}}">{{$optionValue}}</option>
                            @endforeach
                        </select>
                        <hr>
                        <label>Инвентарь</label>
                        <input type="text" class="input" name="quantity">
                        <hr>
                        <label>Цена</label>
                        <input type="text" class="input" name="price">
                    </div>
                </div>
                <div class="titlebar">
                    <h1></h1>
                    <button>Сохранить</button>
                </div>
            </form>
        </section>
    </main>
    <script>
        function showFile(event) {
            let input = event.target;
            let reader = new FileReader();
            reader.onload = function () {
                let dataURL = reader.result;
                let output = document.getElementById('file-preview')
                output.src = dataURL;
            };
            reader.readAsDataURL(input.files[0]);
        }
    </script>
@endsection
