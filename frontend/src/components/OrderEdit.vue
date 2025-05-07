<template>
  <div class="order-edit container">
    <h2 class="page-title">Edit Order</h2>
    <form @submit.prevent="updateOrder" class="order-edit-form">
      <div class="form-group">
        <label for="status" class="label">Status</label>
        <input type="text" v-model="order.status" id="status" class="input" required />
      </div>

      <div class="form-group">
        <label for="customer_id" class="label">Customer</label>
        <select v-model="order.customer_id" id="customer_id" class="select" required>
          <option v-for="customer in customers" :key="customer.id" :value="customer.id">
            {{ customer.name }}
          </option>
        </select>
      </div>

      <div class="button-container">
        <button type="submit" class="btn save-btn">Save Changes</button>
      </div>
    </form>

    <div class="button-container">
      <button @click="goBack" class="btn back-btn">Back to Orders</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      order: {
        id: this.$route.params.id,
        status: '',
        customer_id: null,
      },
      customers: [], // List of customers for the select dropdown
    };
  },
  created() {
    this.fetchOrderData();
    this.fetchCustomers();
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
    async fetchCustomers() {
      try {
        const response = await axios.get('http://localhost:8000/api/customers');
        this.customers = response.data;
      } catch (error) {
        console.error('Error fetching customers:', error);
      }
    },
    async updateOrder() {
      try {
        const response = await axios.put(`http://localhost:8000/api/orders/${this.order.id}/edit`, this.order);
        this.$router.push({ name: 'order-summary', params: { id: this.order.id } });
      } catch (error) {
        console.error('Error updating order:', error);
      }
    },
    goBack() {
      this.$router.push({ name: 'order-list' });
    },
  },
};
</script>

<style scoped>
/* General container style */
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

.order-edit-form {
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
  color: #333;
}

.input, .select {
  width: 100%;
  padding: 10px;
  margin-top: 5px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

.input:focus, .select:focus {
  outline: none;
  border-color: #007bff;
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
  transition: background-color 0.3s ease;
}

.btn.save-btn {
  background-color: #007bff;
  color: white;
}

.btn.save-btn:hover {
  background-color: #0056b3;
}

.btn.back-btn {
  background-color: #6c757d;
  color: white;
}

.btn.back-btn:hover {
  background-color: #5a6268;
}
</style>
