import actions from './actions';
import mutations from './mutations';
import getters from './getters';

const store = JSON.parse(global.store);

const state = store.psx;

export default {
  state,
  mutations,
  actions,
  getters,
};
