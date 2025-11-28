<!-- StarRating.vue -->
<template>
  <div class="star-rating">
    <span
      v-for="i in 5"
      :key="i"
      :class="['star', { 'filled': i <= rating }]"
      @click="$emit('update:rating', i)"
    >★</span>
    <span v-if="showCount" class="review-count">({{ reviewCount }})</span>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'StarRating',
  props: {
    rating: {
      type: Number,
      default: 0
    },
    reviewCount: {
      type: Number,
      default: 0
    },
    showCount: {
      type: Boolean,
      default: true
    }
  }
});
</script>

<style scoped>
.star-rating {
  display: flex;
  align-items: center;
  gap: 4px;
  font-size: 12px;
}

.star {
  color: #ddd;
  cursor: pointer;
  transition: color 0.2s ease;
}

.star:hover,
.star.filled {
  color: #FFD700;
}

.review-count {
  color: #666;
  margin-left: 4px;
}
</style>
