<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Pagamento;
use App\Models\Transacao;
use App\Services\Api\PagamentoService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PagamentoController extends Controller
{
    /**
     * @var PagamentoService
     */
    private $service;

    /**
     * PagamentoController constructor.
     * @param PagamentoService $service
     */
    public function __construct(PagamentoService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transacoes = Transacao::with(['cliente', 'plano', 'status'])->get();

        Log::info('API - Consulta de transacões', [
            'ip' => $request->getClientIp(),
            'dados' => $transacoes->toArray()
        ]);

        return response()->json($transacoes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Api\Pagamento
     * @return \Illuminate\Http\Response
     */
    public function store(Pagamento $request)
    {
        $data = $request->all();

        DB::beginTransaction();
        try {
            $transacao = $this->service->createTransacao($data);
            Log::info('API - Criar Transacão', [
                'ip' => $request->getClientIp(),
                'dados' => $transacao->toArray()
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('API - Criar transação', [
                'ip' => $request->getClientIp(),
                'error_message' => $e->getMessage(),
                'dados' => $data
            ]);
            return response()->json($e->getMessage(), 409);
        }
        DB::commit();

        return response()->json($transacao);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $transacao = Transacao::with(['cliente', 'plano', 'status'])->find($id);

        Log::info('API - Consulta transacão', [
            'ip' => $request->getClientIp(),
            'dados' => $transacao->toArray()
        ]);

        return response()->json($transacao);
    }

    public function retorno(Request $request)
    {
        if ($request->get('transacao_id') && $request->get('status')) {

            $transacao = Transacao::find($request->get('transacao_id'));
            $transacao->update(['status_transacao_id' => $request->get('status')]);

            Log::info('API - Alteração do estatus da transação', [
                'ip' => $request->getClientIp(),
                'dados' => $transacao->toArray()
            ]);

            return response()->json(['accept' => true]);
        }

        Log::error('API - Alteração do estatus da transação', [
            'ip' => $request->getClientIp(),
            'dados_recebidos' => $request->all()
        ]);

        return response()->json(['accept' => false, 'msg' => 'parâmetros de atualização não informados']);
    }
}
