<template>
  <nav class="navigation-bar">
    <h2 class="nav-title">{{ title }}</h2>
    <div class="nav-links">
      <button
        :class="['all-button', { 'active': activeCategory === 'All' }]"
        @click="setActiveCategory('All')"
      >
        {{ allText }}
      </button>
      <a
        v-for="link in links"
        :key="link"
        href="#"
        :class="['nav-link', { 'active': activeCategory === link }]"
        @click.prevent="setActiveCategory(link)"
      >
        {{ link }}
      </a>
    </div>
  </nav>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';

export default defineComponent({
  name: 'NavigationBar',
  props: {
    title: {
      type: String,
      required: true
    },
    links: {
      type: Array as () => string[],
      required: true
    },
    allText: {
      type: String,
      default: 'All'
    }
  },
  setup() {
    const activeCategory = ref('All');

    const setActiveCategory = (category: string) => {
      activeCategory.value = category;
    };

    return {
      activeCategory,
      setActiveCategory
    };
  }
});
</script>

<style scoped>

.navigation-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 20px;
  padding: 15px 0;
  margin-bottom: 10px;
  margin-right: 2%;
  margin-left: 2%;
}

.nav-title {
  font-size: 18px;
  font-weight: 600;
  color: #253D4E;
  margin: 0;
  letter-spacing: 0.5px;
  /* Remove min-width to let it naturally size */
}

.nav-links {
  display: flex;
  gap: 15px;
  flex-wrap: wrap;
  /* This ensures the links stay on the right side */
}

.nav-link {
  color: #253D4E;
  text-decoration: none;
  font-size: 14px;
  font-weight: 500;
  padding: 8px 16px;
  border-radius: 4px;
  transition: all 0.3s ease;
  white-space: nowrap;
  cursor: pointer;
  position: relative;
}

.nav-link:hover,
.nav-link.active {
  color: #3BB77E;
  background-color: rgba(59, 183, 126, 0.1);
  border: 1px solid rgba(59, 183, 126, 0.3);
}

.nav-link.active::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  right: 0;
  height: 2px;
  background-color: #3BB77E;
  border-radius: 2px;
}

.all-button {
  background: #3BB77E;
  color: white;
  border: none;
  padding: 8px 16px;
  border-radius: 4px;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.3s ease;
  white-space: nowrap;
}

.all-button:hover,
.all-button.active {
  background: #29A56C;
  transform: translateY(-1px);
}

.all-button.active {
  box-shadow: 0 2px 4px rgba(59, 183, 126, 0.3);
}


</style>
