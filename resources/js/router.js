import Vue from "vue";
import VueRouter from "vue-router";
import memberDetail from './pages/memberDetail.vue';
import Top from './pages/Top.vue';

export default new VueRouter({
    // mode: 'history',
    routes: [
        {
            path: '/',
            name: 'Top',
            component: Top
          },    
      {
        path: '/member/:id',
        name: 'memberDetail',
        component: memberDetail
      },
    ]
  });