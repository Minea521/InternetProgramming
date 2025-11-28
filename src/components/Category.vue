<template>

  <div class="container">
    <div class="category-card" :style="{ backgroundColor: bgColor, border: '1px solid ' + borderColor }">
      <div class="category-image">
        <img :src="image" :alt="name" />
      </div>
      <div class="category-info">
        <h3 class="category-name">{{ name }}</h3>
        <p class="quantity">{{ quantity }}</p>
      </div>
    </div>
  </div>

</template>

<script lang="ts" setup>
import { defineProps } from 'vue';

defineProps<{
  id: number
  image: string
  name: string
  quantity: string
  bgColor: string
  borderColor: string
}>()

</script>

<style scoped>

.category-card {
  text-align: center;
  padding: 1rem;
  border-radius: 12px;
  background: white;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease;
}

.category-card:hover {
  transform: translateY(-5px);
}

.category-image {
  width: 50px;
  height: 70px;
  border-radius: 5px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 1rem;
  padding: 1rem;
}

.category-image img {
  width: 80px;
  height: 80px;
  object-fit: contain;
}

.category-name {
  font-size: 1rem;
  font-weight: 600;
  color: #333;
  margin: 0 0 0.5rem 0;
}

.quantity {
  font-size: 0.9rem;
  color: #666;
  margin: 0;
}

</style>
