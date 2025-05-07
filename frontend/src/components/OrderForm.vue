<template>
  <div class="order-form container">
    <h2 class="page-title">{{ isEdit ? 'Edit Order' : 'Create Order' }}</h2>
    <form @submit.prevent="submitForm" class="order-form-content">
      <div class="form-group">
        <label for="customer" class="label">Customer</label>
        <select v-model="order.customer_id" id="customer" class="select" required>
          <option v-for="customer in customers" :key="customer.id" :value="customer.id">
            {{ customer.name }}
          </option>
        </select>
      </div>

      <div class="form-group">
        <label class="label">Items</label>
        <div v-for="item in items" :key="item.id" class="form-check">
          <input
            type="checkbox"
            :value="item.id"
            v-model="order.item_ids"
            :id="'item-' + item.id"
            class="checkbox"
          />
          <label :for="'item-' + item.id">{{ item.name }}</label>
        </div>
      </div>

      <div class="form-group">
        <label for="status" class="label">Status</label>
        <select v-model="order.status" id="status" class="select" required>
          <option value="pending">Pending</option>
          <option value="processing">Processing</option>
          <option value="completed">Completed</option>
          <option value="cancelled">Cancelled</option>
        </select>
      </div>

      <div class="form-group">
        <label for="order_date" class="label">Order Date</label>
        <input type="date" v-model="order.order_date" id="order_date" class="input" required />
      </div>

      <div class="button-container">
        <button type="submit" class="btn save-btn">{{ isEdit ? 'Update Order' : 'Create Order' }}</button>
      </div>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      order: {
        customer_id: '',
        status: 'pending',
        order_date: '',
        item_ids: [],
      },
      customers: [],
      items: [],
      isEdit: false,
    };
  },
  async created() {
    this.isEdit = this.$route.params.id ? true : false;
    if (this.isEdit) {
      await this.fetchOrderData(this.$route.params.id);
    }
    await this.fetchCustomers();
    await this.fetchItems();
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
    async fetchItems() {
      try {
        const response = await axios.get('http://localhost:8000/api/items');
        this.items = response.data;
      } catch (error) {
        console.error('Error fetching items:', error);
      }
    },
    async fetchOrderData(id) {
      try {
        const response = await axios.get(`http://localhost:8000/api/orders/${id}`);
        this.order = {
          ...response.data,
          item_ids: response.data.items?.map(item => item.id) || []
        };
      } catch (error) {
        console.error('Error fetching order data:', error);
      }
    },
    async submitForm() {
      try {
        if (this.isEdit) {
          await axios.put(`http://localhost:8000/api/orders/${this.order.id}`, this.order);
        } else {
          await axios.post('http://localhost:8000/api/orders', this.order);
        }
        this.$router.push({ name: 'orders' });
      } catch (error) {
        console.error('Error submitting form:', error);
      }
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

.order-form-content {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
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

.select:focus, .input:focus {
  outline: none;
  border-color: #007bff;
}

.form-check {
  margin-bottom: 8px;
}

.checkbox {
  margin-right: 8px;
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

.save-btn {
  background-color: #007bff;
  color: white;
}

.save-btn:hover {
  background-color: #0056b3;
}
</style>
