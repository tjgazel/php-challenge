export default {

    loading: false,
    form: {
        cliente_id: null,
        nome: '',
        cpf: '',
        email: '',
        contatos: [''],
        cep: '',
        logradouro: '',
        numero: '',
        complemento: '',
        bairro: '',
        cidade: '',
        uf: '',
        plano_id: 1,
        titular: '',
        numero_cartao: '3030 3030 3030 3030',
        ccv: '',
        mes: 1,
        ano: new Date().getFullYear()
    },
    errors: {},
    alert: {
        status: false,
        msg: '',
    },
    planos: [],
    status_transacao: [],
    codigo_transacao: null,
    cadastro: false,
}
