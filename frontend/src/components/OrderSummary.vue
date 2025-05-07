<template>
  <div class="order-summary container">
    <h2 class="page-title">Order Details</h2>
    <div v-if="order" class="order-details">
      <div class="form-group">
        <label class="label">Order ID:</label>
        <p class="value">{{ order.id }}</p>
      </div>

      <div class="form-group">
        <label class="label">Customer:</label>
        <p class="value">{{ order.customer.name }}</p>
      </div>

      <div class="form-group">
        <label class="label">Status:</label>
        <p class="value">{{ order.status }}</p>
      </div>

      <div class="form-group">
        <label class="label">Order Date:</label>
        <p class="value">{{ order.order_date }}</p>
      </div>

      <div class="form-group">
        <label class="label">Items:</label>
        <ul class="items-list">
          <li v-for="item in order.items" :key="item.id" class="item">{{ item.name }}</li>
        </ul>
      </div>

      <div class="button-container">
        <button class="btn back-btn" @click="goBack">Back to Orders</button>
      </div>
    </div>
    <div v-else>
      <p>Loading order details...</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      order: null,
    };
  },
  created() {
    this.fetchOrderData();
  },
  methods: {
    async fetchOrderData() {
      try {
        const response = await axios.get(`http://localhost:8000/api/orders/${this.$route.params.id}/summary`);
        this.order = response.data;
      } catch (error) {
        console.error('Error fetching order data:', error);
      }
    },
    goBack() {
      this.$router.push({ name: 'order-list' });
    },
  },
};
</script>

<style scoped>
/* Add your custom styling here */
.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

.page-title {
  font-size: 2rem;
  margin-bottom: 20px;
  color: #333;
}

.order-details {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.form-group {
  margin-bottom: 15px;
}

.label {
  font-weight: bold;
  font-size: 1.1rem;
}

.value {
  font-size: 1rem;
  color: #555;
}

.items-list {
  list-style: none;
  padding-left: 0;
}

.item {
  padding: 5px 0;
  font-size: 1rem;
  color: #444;
}

.button-container {
  margin-top: 20px;
  text-align: right;
}

.btn {
  padding: 10px 20px;
  font-size: 1rem;
  cursor: pointer;
  border: none;
  border-radius: 5px;
  background-color: #007bff;
  color: white;
  transition: background-color 0.3s ease;
}

.btn:hover {
  background-color: #0056b3;
}

.back-btn {
  background-color: #6c757d;
}

.back-btn:hover {
  background-color: #5a6268;
}
</style>
