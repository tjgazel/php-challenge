export default {
    valorPlano: state => {
        if (state.planos.length) {
            return state.planos.filter(p => p.id == state.form.plano_id)[0].valor;
        }
        return 0;
    },

    descricaoPlano: state => {
        if (state.planos.length) {
            return state.planos.filter(p => p.id == state.form.plano_id)[0].descricao;
        }
        return '';
    }
}
