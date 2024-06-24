<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            
                @if (!Auth::guard('courier')->user())

                @yield('button')
                
                @else
                <a href="{{ route('delivery.table') }}" type="button" class="btn btn-dark">Delivery table</a>
                <a href="{{ route('delivery.list') }}" type="button" class="btn btn-dark">My deliveries</a>
                <a href="{{ route('courier.update') }}" type="button" class="btn btn-dark">Settings</a>

                <form action="{{ route('courier.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-dark">Logout</button>
                </form>
                @endif
            </div>
        </div>
    </header>

    <div class="container mt-5">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>