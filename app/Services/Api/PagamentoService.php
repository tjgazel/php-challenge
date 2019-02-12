<?php

namespace App\Services\Api;


use App\Models\StatusTransacao;
use App\Models\Transacao;

class PagamentoService
{

    public function createTransacao(array $data)
    {
        $data['status_transacao_id'] = $this->simulaChamadaApiPagamentosExterna();

        return Transacao::create($data);
    }

    /**
     * Simula o envio dos dados do cartão/produto e recebe o status de retorno.
     *
     * @return mixed
     */
    private function simulaChamadaApiPagamentosExterna()
    {
        $statusTransacao = StatusTransacao::all();

        $status = $statusTransacao->random();

        return $status->codigo;
    }

}
