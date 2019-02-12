@extends('layout')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h3 class="text-center text-white my-5">Checkout do Pagamento</h3>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <h4>Dados da transação</h4>
                    <p><strong>Código da transação:</strong> {{$transacao->id}}</p>
                    <p><strong>Status:</strong> {{$transacao->status->descricao}}</p>
                </div>
                <div class="col-12 col-md-10 col-lg-8 mt-5">
                    <p>Obrigado por se inscrever!, logo enviaremos um e-mail com seus dados de acesso.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
