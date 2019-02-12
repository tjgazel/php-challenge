<template>
    <div>
        <div class="row mt-3">
            <div class="form-group col-12 col-md-4">
                <label>CEP</label>
                <input type="text" :class="['form-control', {'is-invalid': !!errors.cep}]" v-mask="'#####-###'" :v-masked="true"
                       :value="form.cep" @keyup="setCep($event.target.value)">
                <span v-if="!!errors.cep" class="text-danger">{{errors.cep[0]}}</span>
            </div>
            <div class="form-group col-12 col-md-8">
                <label>Logradouro</label>
                <input type="text" :class="['form-control', {'is-invalid': !!errors.logradouro}]"
                       :value="form.logradouro" @keyup="setLogradouro($event.target.value)"
                       placeholder="Digite o cep primeiro">
                <span v-if="!!errors.logradouro" class="text-danger">{{errors.logradouro[0]}}</span>
            </div>
            <div class="form-group col-6 col-md-3">
                <label>Número</label>
                <input type="text" :class="['form-control', {'is-invalid': !!errors.numero}]"
                       :value="form.numero" @keyup="setNumero($event.target.value)">
                <span v-if="!!errors.numero" class="text-danger">{{errors.numero[0]}}</span>
            </div>
            <div class="form-group col-6 col-md-3">
                <label>Complemento</label>
                <input type="text" class="form-control" :value="form.complemento"
                       @keyup="setComplemento($event.target.value)">
            </div>
            <div class="form-group col-12 col-md-6">
                <label>Bairro</label>
                <input type="text" :class="['form-control', {'is-invalid': !!errors.bairro}]"
                       :value="form.bairro" @keyup="setBairro($event.target.value)" placeholder="Digite o cep primeiro">
                <span v-if="!!errors.bairro" class="text-danger">{{errors.bairro[0]}}</span>
            </div>
            <div class="form-group col-12 col-md-8">
                <label>Cidade</label>
                <input type="text" :class="['form-control', {'is-invalid': !!errors.cidade}]"
                       :value="form.cidade" @keyup="setCidade($event.target.value)" placeholder="Digite o cep primeiro">
                <span v-if="!!errors.cidade" class="text-danger">{{errors.cidade[0]}}</span>
            </div>
            <div class="form-group col-12 col-md-4">
                <label>UF</label>
                <input type="text" :class="['form-control', {'is-invalid': !!errors.uf}]"
                       :value="form.uf" @keyup="setUf($event.target.value)" placeholder="Digite o cep primeiro">
                <span v-if="!!errors.uf" class="text-danger">{{errors.uf[0]}}</span>
            </div>
        </div>
    </div>
</template>

<script>
    import {mask, masked} from 'vue-the-mask';
    import {createNamespacedHelpers} from 'vuex';

    const {mapState, mapMutations, mapActions} = createNamespacedHelpers('Inscricao');

    export default {
        directives: {mask, masked},
        computed: {
            ...mapState(['form', 'errors'])
        },

        methods: {
            ...mapMutations(['FORM']),
            ...mapActions(['buscaCep']),

            setCep: _.debounce(function (value) {
                this.FORM({...this.form, cep: value});
                if (value.length == 9) {
                    this.buscaCep();
                }
            }, 1000),

            setLogradouro(value) {
                this.FORM({...this.form, logradouro: value});
            },

            setNumero(value) {
                this.FORM({...this.form, numero: value});
            },

            setComplemento(value) {
                this.FORM({...this.form, complemento: value});
            },

            setBairro(value) {
                this.FORM({...this.form, bairro: value});
            },

            setCidade(value) {
                this.FORM({...this.form, cidade: value});
            },

            setUf(value) {
                this.FORM({...this.form, uf: value});
            },
        }
    }
</script>
