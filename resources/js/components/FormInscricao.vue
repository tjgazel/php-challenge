<template>
    <div style="min-height: 400px;">
        <div v-show="alert.status" class="alert alert-danger" role="alert">
            <strong>Erro: </strong> {{alert.msg}}
        </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link text-white active" id="dados-pessoais-tab" data-toggle="tab" href="#dados-pessoais"
                   role="tab" aria-controls="dados-pessoais" aria-selected="true">Dados Pessoais</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" id="endereco-tab" data-toggle="tab" href="#endereco" role="tab"
                   aria-controls="endereco" aria-selected="false">Endereço</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" id="planos-tab" data-toggle="tab" href="#planos" role="tab"
                   aria-controls="planos" aria-selected="false">Planos e Pagamento</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active mt-3" id="dados-pessoais" role="tabpanel"
                 aria-labelledby="dados-pessoais-tab">
                <dados-pessoais/>
            </div>
            <div class="tab-pane fade mt-3" id="endereco" role="tabpanel" aria-labelledby="endereco-tab">
                <endereco/>
            </div>
            <div class="tab-pane fade mt-3" id="planos" role="tabpanel" aria-labelledby="planos-tab">
                <planos/>
            </div>
        </div>

        <checkout-modal></checkout-modal>

    </div>
</template>

<script>
    import DadosPessoais from './DadosPessoais';
    import Endereco from './Endereco';
    import Planos from './Planos';
    import CheckoutModal from './CheckoutModal';
    import {createNamespacedHelpers} from 'vuex';

    const {mapState, mapMutations} = createNamespacedHelpers('Inscricao');

    export default {
        components: {DadosPessoais, Endereco, Planos, CheckoutModal},
        props: ['dataPlanos'],

        mounted() {
            this.PLANOS(JSON.parse(this.dataPlanos));
        },

        computed: {
          ...mapState(['alert'])
        },

        methods: {
            ...mapMutations(['PLANOS'])
        }
    }
</script>

<style type="text/css" scoped>
    .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
        background-color: transparent;
    }
</style>
