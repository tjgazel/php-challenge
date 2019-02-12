<?php

namespace App\Http\Controllers;


use App\Models\Transacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class InscricaoController
 * @package App\Http\Controllers
 */
class CheckoutController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $transacaoId)
    {
        $transacao = Transacao::find($transacaoId);

        return view('inscricao.checkout', compact('transacao'));
    }

}
