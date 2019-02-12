<template>
    <div class="modal fade" ref="checkout" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content text-dark">
                <div class="modal-body">
                    <div class="row">
                        <h3 class="col-12 mb-5">Checkout pagamento</h3>
                        <div class="col">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th colspan="2"><h4>Dados do assinante</h4></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th>Assinante:</th>
                                    <td>{{form.nome}}</td>
                                </tr>
                                <tr>
                                    <th>CPF:</th>
                                    <td>{{form.cpf | cpf}}</td>
                                </tr>
                                <tr>
                                    <th>Contato:</th>
                                    <td>{{form.contatos[0]}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th colspan="2"><h4>Dados do cartão</h4></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th>Titular:</th>
                                    <td>{{form.titular}}</td>
                                </tr>
                                <tr>
                                    <th>Número:</th>
                                    <td>{{form.numero_cartao}}</td>
                                </tr>
                                <tr>
                                    <th>Expiração:</th>
                                    <td>{{form.mes}}/{{form.ano}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col">
                            <table class="table">
                                <thead>
                                <tr class="text-center">
                                    <th colspan="2"><h4>Plano</h4></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th class="text-right">{{descricaoPlano}}</th>
                                    <th><h2>{{valorPlano | currency}}</h2></th>
                                </tr>
                                <tr>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12">
                            <div v-show="alert.status" class="alert alert-danger" role="alert">
                                <strong>Erro: </strong> {{alert.msg}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" :disabled="loading">Alterar dados</button>
                    <button type="button" class="btn btn-primary" @click="checkout" :disabled="loading">
                        Confirmar Pagamento
                        <span v-if="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import {createNamespacedHelpers} from 'vuex';

    const {mapState, mapGetters, mapMutations, mapActions} = createNamespacedHelpers('Inscricao');

    export default {

        computed: {
            ...mapState(['cadastro', 'form', 'alert', 'loading']),
            ...mapGetters(['valorPlano', 'descricaoPlano'])
        },

        mounted() {
            $(this.$refs.checkout).modal({backdrop: 'static', show: false});
            let vm = this;
            $(this.$refs.checkout).on('hidden.bs.modal', function (e) {
                vm.CADASTRO(false);
            })
        },

        methods: {
            ...mapMutations(['CADASTRO']),
            ...mapActions(['checkout'])
        },

        watch: {
            cadastro: function (value) {
                if (value) {
                    $(this.$refs.checkout).modal('show');
                }
            }
        },

        filters: {
            cpf(value) {
                return value.substr(0, 3) + '.' + value.substr(3, 3) + '.' + value.substr(6, 3) + '-' + value.substr(9, 2);
            },
        }
    }
</script>
