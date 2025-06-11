import { createRouter, createWebHistory } from "vue-router";
import OrderList from "../components/OrderList.vue";
import OrderForm from "../components/OrderForm.vue";
import OrderSummary from "../components/OrderSummary.vue";
import OrderEdit from "../components/OrderEdit.vue";

const routes = [
  {
    path: "/orders",
    name: "order-list",
    component: OrderList
  },
  {
    path: "/",
    name: "order-list",
    component: OrderList
  },
  {
    path: "/orders/create",
    name: "order-create",
    component: OrderForm
  },
  {
    path: '/orders/:id/summary',
    name: 'order-summary',
    component: OrderSummary,
  },
  {
    path: '/orders/:id/edit',
    name: 'order-edit',
    component: OrderEdit,
  },
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
});

export default router;
