@if(count(\Cart::getContent()) > 0)
    @foreach(\Cart::getContent() as $item)
        <li class="list-group-item">
            <div class="row">
                <div class="col-lg-3">
                    <img src="/images/{{ $item->attributes->imagen }}"
                         style="width: 50px; height: 50px;"
                    >
                </div>
                <div class="col-lg-6">
                    <b>{{$item->nombre}}</b>
                    <br><small>Cant.: {{$item->cantidad}}</small>
                </div>
                <div class="col-lg-3">
                    <p>${{ \Cart::get($item->id)->getPriceSum() }}</p>
                </div>
                <hr>
            </div>
        </li>
    @endforeach
    <br>
    <li class="list-group-item">
        <div class="row">
            <div class="col-lg-10">
                <b>Total: </b>${{ \Cart::getTotal() }}
            </div>
            <div class="col-lg-2">
                <form action="{{ route('articulos.cart') }}" method="POST">
                    {{ csrf_field() }}
                    <button class="btn btn-secondary btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </li>
    <br>
    <div class="row" style="margin: 0px;">
        <a class="btn btn-dark btn-sm btn-block" href="{{ route('articulos.cart') }}">
            Carrito
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
            </svg>
        </a>
        <a class="btn btn-dark btn-sm btn-block" href="#">
            Realizar compra
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
            </svg>
        </a>
    </div>
@else
    <li class="list-group-item">Tu carrito está vacío</li>
@endif
