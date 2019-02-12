export default {

    buscaCep(context) {
        const csrfToken = axios.defaults.headers.common['X-CSRF-TOKEN'];
        delete axios.defaults.headers.common['X-CSRF-TOKEN'];

        axios.get(`https://viacep.com.br/ws/${context.state.form.cep}/json/`)
            .then(res => {
                axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
                context.commit('FORM', {
                    ...context.state.form,
                    logradouro: res.data.logradouro,
                    bairro: res.data.bairro,
                    cidade: res.data.localidade,
                    uf: res.data.uf
                });
                if (res.data.erro) {
                    context.commit('ERRORS', {...context.state.errors, cep: ['Não encontrado']});
                } else {
                    if (context.state.errors.cep) {
                        let errors = {...context.state.errors};
                        delete errors.cep;
                        context.commit('ERRORS', {...errors});
                    }
                }
            })
            .catch(error => axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken);
    },

    inscricao(context) {
        context.commit('LOADING', true);
        axios.post('/inscricao', context.state.form)
            .then(res => {
                context.dispatch('resetErros');
                context.commit('CADASTRO', true);
                context.commit('FORM', {...context.state.form, cliente_id: res.data.id});
            })
            .catch(error => {
                if (error.response.status == 422) {
                    context.commit('ERRORS', error.response.data.errors);
                    context.commit('ALERT', {
                        status: true,
                        msg: 'Por favor confira todos os formulários e corrija os erros em destaque.'
                    });
                } else {
                    context.commit('ALERT', {
                        status: true,
                        msg: 'Ocorreu um erro desconhecido, por favor informe ao administrador do sistema.'
                    });
                }
                context.commit('LOADING', false);
            })
    },

    checkout(context) {
        context.commit('LOADING', true);
        axios.post('/api/pagamentos', context.state.form)
            .then(res => {
                window.location = `/checkout/${res.data.id}`;
            })
            .catch(error => {
                if (error.response.status == 422) {
                    context.commit('ERRORS', error.response.data.errors);
                    context.commit('ALERT', {
                        status: true,
                        msg: 'Número de cartão inválido'
                    });
                } else {
                    console.log(error.response);
                    context.commit('ALERT', {
                        status: true,
                        msg: 'Ocorreu um erro desconhecido, por favor informe ao administrador do sistema.'
                    });
                }
                context.commit('LOADING', false);
            })
    },

    resetErros(context) {
        context.commit('LOADING', false);
        context.commit('ALERT', {status: false, msg: ''});
        context.commit('ERRORS', {});
    }
}
