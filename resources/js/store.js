import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)
export default new Vuex.Store(
    {
        state: {
            auth: false,
            HR: false,
        },
        mutations: {
            checkAuth(state, status) {
                if (typeof status.id !== 'undefined') {
                    state.auth = true;
                    if (status.id === 1) {
                        state.HR = true;
                    }
                }
            }
        },
        actions: {
            isAuth({ commit }) {
                axios
                .get("/giftbox/public/api/user")
                .then((response) => {
                    commit('checkAuth', response.data);
                })
                .catch((error) => {
                    commit('checkAuth', error);
                });
            }
        }
    }
)
