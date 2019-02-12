<?php

namespace App\Http\Controllers;

use App\Http\Requests\Inscricao;
use App\Models\Plano;
use App\Services\InscricaoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class InscricaoController
 * @package App\Http\Controllers
 */
class InscricaoController extends Controller
{
    /**
     * @var InscricaoService
     */
    private $service;

    /**
     * InscricaoController constructor.
     * @param InscricaoService $service
     */
    public function __construct(InscricaoService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $planos = Plano::all();
        return view('inscricao.index', compact(['planos']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Inscricao $request)
    {
        $data = $request->all();
        DB::beginTransaction();
        try {
            $result = $this->service->registrar($data);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 409);
        }

        DB::commit();
        return response()->json($result);
    }

}
