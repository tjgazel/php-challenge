@extends('layout')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h3 class="text-center text-white mt-5">Faça já sua inscrição!</h3>
                </div>
            </div>
            <div class="row py-5 justify-content-center">
                <div class="col-12 col-md-10 col-lg-8  py-3">
                    <form-inscricao
                        data-planos="{{$planos}}">
                    </form-inscricao>
                </div>
            </div>
        </div>
    </section>
@endsection
