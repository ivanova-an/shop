@extends('layouts.app')
@section('content')
    <main class="container">
        <section>
            <div class="titlebar">
                <h1>Список продуктов</h1>

                <a href="{{route('products.create')}}" class="btn-link">Добавить продукт</a>
                {{--                <button>Add Product</button>--}}
            </div>
            @if($message = Session::get('success'))
                <script type="text/javascript">
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        titleText: 'Товар успешно добавлен!',
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "success",
                        title: "{{$message}}"
                    });
                </script>
            @endif
            <div class="table">
                <div class="table-filter">
                    <div>
                        <ul class="table-filter-list">
                            <li>
                                <p class="table-filter-link link-active">Список</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <form method="GET" action="{{route('products.index')}}" accept-charset="UTF-8" role="search">
                    <div class="table-search">
                        <div>
                            <button class="search-select">
                                Найти продукт
                            </button>
                            <span class="search-select-arrow">
                            <i class="fas fa-caret-down"></i>
                        </span>
                        </div>
                        <div class="relative">
                            <input class="search-input" type="text" name="search" placeholder="Поиск..."
                                   value="{{ request('search') }}"
                            >
                        </div>
                    </div>
                </form>
                <div class="table-product-head">
                    <p>Изображение</p>
                    <p>Название</p>
                    <p>Категория</p>
                    <p>Инвентарь</p>
                    <p>Редактировать/Удалить</p>
                </div>
                <div class="table-product-body">
                    @if(count($products) > 0)
                        @foreach($products as $product)
                            <img src="{{asset('images/' . $product->image)}}"/>
                            <p>{{$product->name}}</p>
                            <p>{{$product->category}}</p>
                            <p>{{$product->quantity}}</p>
                            <div style="display: flex; align-items: center"; >
                                <button  class="btn btn-success" >
                                    <a href="{{route('products.edit', $product->id)}}" >
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </button>
                                <form method="post" action="{{route('products.destroy', $product->id)}}">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger" onclick="deleteConfirm(event)">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>

                            </div>
                        @endforeach
                    @else
                        <p class="notFoundText">Продукт не найден</p>
                    @endif
                </div>
                <div class="table-paginate">
                    {{$products->links('layouts.pagination')}}

                </div>
            </div>
        </section>
    </main>
    <script>
        window.deleteConfirm = function (e){
            e.preventDefault();
            let form = e.target.form;
            Swal.fire({
                title: "Вы уверены?",
                text: "Вы не сможете это вернуть!",
                icon: "warning",
                showCancelButton: true,
                cancelButtonText: 'Отмена',
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Да, удалить!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
@endsection
