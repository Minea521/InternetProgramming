import { defineStore } from 'pinia';
import axios from 'axios';

export const useProductStore = defineStore('product', {
  state: () => ({
    groups: [],
    promotions: [],
    categories: [],
    products: []
  }),
  getters: {
    // Example getter: get all categories (add more as needed)
    getCategories(state) {
      return state.categories;
    },
    getPromotions(state) {
      return state.promotions;
    },
    getGroups(state) {
      return state.groups;
    },
    getProducts(state) {
      return state.products;
    }
  },
  actions: {
    
  }
});
