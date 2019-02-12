<?php

Route::redirect('/', '/inscricao');

Route::resource('/inscricao', 'InscricaoController')->only(['index', 'store']);

Route::name('checkout')->get('checkout/{transacaoId}', 'CheckoutController@index');
