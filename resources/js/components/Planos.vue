<template>
    <div>
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Planos de assinatura</h5>
                        <div class="form-group">
                            <select class="form-control" :value="form.plano_id" @change="setPlano($event.target.value)">
                                <option v-for="plano in planos" :value="plano.id">{{plano.descricao}}</option>
                            </select>
                        </div>
                        <h3 class="text-center">{{valorPlano | currency}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <h5>Dados do cartão</h5>
                <div class="form-group">
                    <label>Titular</label>
                    <input type="text" :class="['form-control', {'is-invalid': !!errors.titular}]"
                           :value="form.titular" @keyup="setTitular($event.target.value)">
                    <span v-if="!!errors.titular" class="text-danger">{{errors.titular[0]}}</span>
                </div>
                <div class="row">
                    <div class="form-group col-8">
                        <label>Nº cartão</label>
                        <input type="text" :class="['form-control', {'is-invalid': !!errors.numero_cartao}]"
                               :value="form.numero_cartao" @keyup="setNumero($event.target.value)"
                               v-mask="'#### #### #### ####'">
                        <span v-if="!!errors.numero_cartao" class="text-danger">{{errors.numero_cartao[0]}}</span>
                    </div>
                    <div class="form-group col-4">
                        <label>Código Segurança</label>
                        <input type="text" :class="['form-control', {'is-invalid': !!errors.ccv}]" v-mask="'###'"
                               :value="form.ccv" @keyup="setCcv($event.target.value)">
                        <span v-if="!!errors.ccv" class="text-danger">{{errors.ccv[0]}}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6 col-md-4">
                        <label>Mês expiração</label>
                        <select class="form-control" :value="form.mes" @change="setMes($event.target.value)">
                            <option v-for="mes in meses" :value="mes">{{mes}}</option>
                        </select>
                    </div>
                    <div class="form-group col-6 col-md-4">
                        <label>Ano expiração</label>
                        <select class="form-control" :value="form.ano" @change="setAno($event.target.value)">
                            <option v-for="ano in anos" :value="ano">{{ano}}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col text-right">
                <button class="btn btn-success" @click="inscricao" :disabled="loading">
                    Continuar <i v-if="!loading" class="fas fa-arrow-right"></i>
                    <span v-if="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>

    import {mask} from 'vue-the-mask';
    import {createNamespacedHelpers} from 'vuex';

    const {mapState, mapGetters, mapMutations, mapActions} = createNamespacedHelpers('Inscricao');

    export default {
        directives: {mask},
        data() {
            return {
                meses: _.range(1, 13),
                anos: _.range(new Date().getFullYear(), new Date().getFullYear() + 11),
            }
        },
        computed: {
            ...mapState(['form', 'errors', 'planos', 'loading']),
            ...mapGetters(['valorPlano'])
        },

        methods: {
            ...mapMutations(['FORM']),
            ...mapActions(['inscricao']),

            setPlano(value) {
                this.FORM({...this.form, plano_id: value});
            },
            setTitular(value) {
                this.FORM({...this.form, titular: value});
            },
            setNumero(value) {
                this.FORM({...this.form, numero_cartao: value});

            },
            setCcv(value) {
                this.FORM({...this.form, ccv: value});

            },
            setMes(value) {
                this.FORM({...this.form, mes: value});
            },
            setAno(value) {
                this.FORM({...this.form, ano: value});
            }
        }
    }
</script>

<style type="text/css" scoped>
    .card {
        background-color: transparent;
    }
</style>
