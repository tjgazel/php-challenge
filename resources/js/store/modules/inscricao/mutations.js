export default {
    LOADING(state, value) {
        state.loading = value;
    },

    ERRORS(state, obj) {
        state.errors = obj;
    },

    ALERT(state, obj) {
        state.alert = obj;
    },

    PLANOS(state, data) {
        state.planos = data;
    },

    FORM(state, form) {
        state.form = form;
    },

    ADD_FORM_CONTATO(state) {
        state.form.contatos.push('');
    },

    SET_FORM_CONTATO(state, payload) {
        state.form.contatos[payload.index] = payload.value;
    },

    REMOVE_FORM_CONTATO(state, index) {
        state.form.contatos.splice(index, 1);
    },

    CADASTRO(state, value) {
        state.cadastro = value;
    }
}
