<!-- ProductCard.vue -->
<template>
  <div class="product-card">
    <div class="product-image">
      <img :src="product.image" :alt="product.name" />
      <div v-if="product.discount" class="discount-badge">-{{ product.discount }}%</div>
      <div v-if="product.isHot" class="hot-badge">Hot</div>
    </div>
    <div class="product-details">
      <div class="brand">{{ product.brand }}</div>
      <h3 class="product-name">{{ product.name }}</h3>
      <div class="rating">
        <span v-for="i in 5" :key="i" :class="['star', { 'filled': i <= product.rating }]">★</span>
        <span class="review-count">({{ product.reviewCount }})</span>
      </div>
      <div class="weight">{{ product.weight }}</div>
      <div class="price">
        <span class="current-price">${{ product.currentPrice }}</span>
        <span v-if="product.originalPrice" class="original-price">${{ product.originalPrice }}</span>
      </div>
      <button class="add-button">Add +</button>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'ProductCard',
  props: {
    product: {
      type: Object,
      required: true
    }
  }
});
</script>

<style scoped>
/* Style for individual product card */
.product-card {
  border: 1px solid #e0e0e0;
  border-radius: 8px;
  overflow: hidden;
  background: white;
  transition: transform 0.2s ease;
}

.product-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.product-image {
  position: relative;
  height: 200px;
  overflow: hidden;
}

.product-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.discount-badge, .hot-badge {
  position: absolute;
  top: 8px;
  left: 8px;
  padding: 4px 8px;
  border-radius: 4px;
  font-size: 12px;
  font-weight: 600;
  color: white;
}

.discount-badge {
  background-color: #FF6B6B;
}

.hot-badge {
  background-color: #FF9F43;
}

.product-details {
  padding: 15px;
}

.brand {
  font-size: 12px;
  color: #666;
  margin-bottom: 4px;
}

.product-name {
  font-size: 14px;
  font-weight: 600;
  color: #253D4E;
  margin: 0 0 8px 0;
  line-height: 1.3;
}

.rating {
  display: flex;
  align-items: center;
  gap: 4px;
  margin-bottom: 8px;
  font-size: 12px;
}

.star {
  color: #ddd;
  font-size: 14px;
}

.star.filled {
  color: #FFD700;
}

.review-count {
  color: #666;
  margin-left: 4px;
}

.weight {
  font-size: 12px;
  color: #666;
  margin-bottom: 8px;
}

.price {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 12px;
}

.current-price {
  font-size: 16px;
  font-weight: 600;
  color: #3BB77E;
}

.original-price {
  font-size: 14px;
  color: #999;
  text-decoration: line-through;
}

.add-button {
  width: 100%;
  padding: 8px;
  background: #f0f0f0;
  border: none;
  border-radius: 4px;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  transition: background 0.2s ease;
}

.add-button:hover {
  background: #e0e0e0;
}
</style>
