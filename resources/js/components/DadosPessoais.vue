<template>
    <div>
        <div class="row">
            <div class="form-group col-12">
                <label>Nome completo</label>
                <input type="text" :class="['form-control', {'is-invalid': !!errors.nome}]"
                       :value="form.nome" @keyup="setNome($event.target.value)">
                <span v-if="!!errors.nome" class="text-danger">{{errors.nome[0]}}</span>
            </div>
            <div class="form-group col-12 col-md-6">
                <label>CPF</label>
                <the-mask type="text" :class="['form-control', {'is-invalid': !!errors.cpf}]" :mask="'###.###.###-##'"
                          :value="form.cpf" @input="setCpf"></the-mask>
                <span v-if="!!errors.cpf" class="text-danger">{{errors.cpf[0]}}</span>
            </div>
            <div class="form-group col-12 col-md-6">
                <label class="">E-mail</label>
                <input type="text" :class="['form-control', {'is-invalid': !!errors.email}]"
                       :value="form.email" @keyup="setEmail($event.target.value)">
                <span v-if="!!errors.email" class="text-danger">{{errors.email[0]}}</span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-12 col-md-6 mb-0" v-for="(contato, index) in form.contatos">
                <label>Contato</label>
                <div class="input-group">
                    <input type="text" class="form-control" v-mask="['(##) ####-####', '(##) #####-####']"
                           :value="contato" @keyup="setContato($event.target.value, index)">
                    <div class="input-group-append">
                        <button v-if="form.contatos.length < 2" class="btn btn-success" type="button"
                                @click="ADD_FORM_CONTATO">
                            <i class="fas fa-plus"></i>
                        </button>
                        <button v-if="form.contatos.length > 1" @click="removeContato($event, index)"
                                class="btn btn-danger"
                                type="button">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
            </div>
            <span v-if="!!errors.contatos" class="text-danger col-12">{{errors.contatos[0]}}</span>
        </div>
    </div>
</template>

<script>

    import {TheMask} from 'vue-the-mask';
    import {mask} from 'vue-the-mask';
    import {createNamespacedHelpers} from 'vuex';

    const {mapState, mapMutations, mapActions} = createNamespacedHelpers('Inscricao');

    export default {
        components: {TheMask},
        directives: {mask},
        computed: {
            ...mapState(['form', 'errors']),
        },

        methods: {
            ...mapMutations(['FORM', 'SET_FORM_CONTATO', 'REMOVE_FORM_CONTATO', 'ADD_FORM_CONTATO']),
            ...mapActions([]),

            setNome(value) {
                this.FORM({...this.form, nome: value});
            },
            setCpf(value) {
                this.FORM({...this.form, cpf: value});
            },
            setEmail(value) {
                this.FORM({...this.form, email: value});
            },
            setContato(value, index) {
                this.SET_FORM_CONTATO({value, index});
            },
            removeContato(event, index) {
                this.REMOVE_FORM_CONTATO(index);
            },
        },

    }
</script>
