@extends('staff.layouts.main')

@section('title')
Cafe orders
@endsection

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Список заказов</h1>
    <div class="card mb-3">
        <div class="card-header">
            <strong>Имя клиента:</strong> Иван Иванов
        </div>
        <div class="card-body">
            <p><strong>Номер клиента:</strong> +7 123 456 78 90</p>
            <table class="table table-striped">
            <p><strong>Доставка:</strong> Нет</p>
                <thead>
                    <tr>
                        <th>ID товара</th>
                        <th>Название</th>
                        <th>Количество</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Пицца</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Салат</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Сок</td>
                        <td>3</td>
                    </tr>
                </tbody>
                <button class="btn btn-success">Выдан</button>
            </table>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <strong>Имя клиента:</strong> Мария Петрова
        </div>
        <div class="card-body">
            <p><strong>Номер клиента:</strong> +7 987 654 32 10</p>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID товара</th>
                        <th>Название</th>
                        <th>Количество</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>4</td>
                        <td>Бургер</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Картофель фри</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Кола</td>
                        <td>2</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection