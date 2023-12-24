import {createRouter, createWebHistory} from 'vue-router';
import CategoryIndex from "@/pages/CartegoryIndex.vue";


const routes = [
    {
        path: '/categories',
        name: 'CategoryIndex',
        component: CategoryIndex
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;