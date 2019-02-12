import Vue from 'vue';
import Vuex from 'vuex';

import Inscricao from './modules/inscricao';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        Inscricao
    },
    strict: process.env.NODE_ENV !== 'production'
});
