<template>
  <div class="order-dashboard">
    <h2 class="dashboard-title">Orders Dashboard</h2>
    <div class="filters">
    <div class="col3">
    <div class="form-group">
    <div class="form-group">
        <label for="status" class="label">Status</label>
        <select v-model="filters.status" id="status" class="select" required>
          <option value="pending">Pending</option>
          <option value="processing">Processing</option>
          <option value="completed">Completed</option>
          <option value="cancelled">Cancelled</option>
        </select>
      </div>
      </div>
      </div>
      <div class="col3">
      <div class="form-group">
        <label for="customer" class="label">Customer</label>
        <select v-model="filters.customer_id" id="customer" class="select" required>
          <option v-for="customer in customers" :key="customer.id" :value="customer.id">
            {{ customer.name }}
          </option>
        </select>
      </div>
      </div>
      <div class="col3 btn-wrap">
      <button @click="fetchOrders">Filter</button>
      </div>
      <div class="col3 btn-create"> <button @click="createOrder">Create Order</button></div>
    </div>
    <table class="order-table">
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Customer</th>
          <th>Status</th>
          <th>Order Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="order in orders" :key="order.id">
          <td>{{ order.id }}</td>
          <td>{{  order.customer.name }}</td>
          <td>{{ order.status }}</td>
          <td>{{ order.order_date }}</td>
          <td>
            <button @click="viewOrder(order.id)">View</button>
            <button @click="editOrder(order.id)">Edit</button>
          </td>
        </tr>
      </tbody>
    </table>
   
  </div>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
    customers: [],
      orders: [],
      filters: {
        status: '',
        customer_id: '',
      },
    };
  },
  async created() {
    await this.fetchCustomers();
  },
  methods: {
    async fetchCustomers() {
      try {
        const response = await axios.get('http://localhost:8000/api/customers');
        this.customers = response.data;
      } catch (error) {
        console.error('Error fetching customers:', error);
      }
    },
    async fetchOrders() {
      try {
        const response = await axios.get('http://localhost:8000/api/orders', {
          params: this.filters,
        });
        this.orders = response.data;
      } catch (error) {
        console.error('Error fetching orders:', error);
      }
    },
    viewOrder(id) {
      this.$router.push({ name: 'order-summary', params: { id } });
    },
    editOrder(id) {
      this.$router.push({ name: 'order-edit', params: { id } });
    },
    createOrder() {
      this.$router.push({ name: 'order-create' });
    },
  },
  mounted() {
    this.fetchOrders();
  },
};
</script>

<style scoped>
.order-dashboard {
  padding: 20px;
  background-color: #f8f9fa;
}
.dashboard-title {
  font-size: 24px;
  margin-bottom: 20px;
}
.filters {
  margin-bottom: 20px;
}
.filters input {
  padding: 8px;
  margin-right: 10px;
}
.form-group {
  margin-bottom: 20px;
}

.label {
  font-weight: bold;
  font-size: 1.1rem;
  color: #333;
}

.select, .input {
  width: 100%;
  padding: 10px;
  margin-top: 5px;
  border-radius: 5px;
  border: 1px solid #ccc;
}
.filters button {
  padding: 8px;
  background-color: #007bff;
  color: white;
  border: none;
  cursor: pointer;
}
.filters button:hover {
  background-color: #0056b3;
}
.order-table {
  width: 100%;
  border-collapse: collapse;
}
.order-table th, .order-table td {
  padding: 12px;
  border: 1px solid #ddd;
}
.order-table th {
  background-color: #f1f1f1;
}
button {
  padding: 6px 12px;
  background-color: #28a745;
  color: white;
  border: none;
  cursor: pointer;
}
button:hover {
  background-color: #218838;
}
.filters .col3 {
    width: 25%;
    float: left;
        margin-right: 1%;
}
.col3.btn-wrap {
    padding-top: 30px;
}
.col3.btn-create {
    width: 21% !important;
    text-align: right;
    margin-top: 30px;
}
</style>
