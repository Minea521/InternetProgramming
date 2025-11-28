<!-- <template>

    <div class="listContainer">
      <div class="categoryList">
        <CategoryCard
        v-for="product in products"
        :key="product.name"
        :image="product.image"
        :name="product.name"
        :quantity="product.quantity"
        :bgColor="product.bgColor"
        :borderColor="product.borderColor"
        />
      </div>
    </div>

    <div class="secondContainer">

      <div class="promotionList">
        <PromotionCard
        v-for="promotion in promotions"
        :key="promotion.id"
        :Description="promotion.Description"
        :image="promotion.image"
        :bgcolor="promotion.bgcolor"
        :buttonText="promotion.buttonText"
        :buttonColor="promotion.buttonColor"
        />

      </div>

    </div>

</template>

<script lang="ts">
import axios from 'axios';
import CategoryCard from './components/Category.vue';
import PromotionCard from './components/Promotion.vue';
import ButtonCard from './components/Button.vue';

import Hamburger from '@/assets/Hamburger.png';
import Peach from '@/assets/Peach.png';
import Kiwi from '@/assets/Kiwi.png';
import Apple from '@/assets/Apple.png';
import Snack from '@/assets/Snack.png';
import BlackPlum from '@/assets/BlueBerry.png';
import Vegetable from '@/assets/Vegetable.png';
import Headphone from '@/assets/Headphones.png';
import Cake from '@/assets/Cake.png';
import Orange from '@/assets/Orange.png';

import onion from '@/assets/onion.png';
import strawberryJuice from '@/assets/strawberry-juice.png';
import mixed_vegetable from '@/assets/mixed-vegetable.png';

export default {
  name: 'App',
  components: {
    CategoryCard,
    PromotionCard
  },

  data() {
    return {
      products: [
        {image: Hamburger, name: 'Cake & Milk', quantity: '14 Items', bgColor: '#F2FCE4', borderColor: '#81B13D'},
        {image: Peach, name: 'Peach', quantity: '17 Items', bgColor: '#FFFCEB', borderColor: '#81B13D'},
        {image: Kiwi, name: 'Organic Kiwi', quantity: '12 Items', bgColor: '#ECFFEC', borderColor: '#81B13D'},
        {image: Apple, name: 'Red Apple', quantity: '20 Items', bgColor: '#FEEFEA', borderColor: '#81B13D'},
        {image: Snack, name: 'Snack', quantity: '10 Items', bgColor: '#FFF3EB', borderColor: '#81B13D'},
        {image: BlackPlum, name: 'Black Plum', quantity: '8 Items', bgColor: '#FFF3FF', borderColor: '#81B13D'},
        {image: Vegetable, name: 'Vegetable', quantity: '15 Items', bgColor: '#F2FCE4', borderColor: '#81B13D'},
        {image: Headphone, name: 'Headphone', quantity: '9 Items', bgColor: '#FFFCEB', borderColor: '#81B13D'},
        {image: Cake, name: 'Cake', quantity: '11 Items', bgColor: '#F2FCE4', borderColor: '#81B13D'},
        {image: Orange, name: 'Orange', quantity: '13 Items', bgColor: '#FFF3FF', borderColor: '#81B13D'},
      ],

      promotions: [
        {id: 1, Description: 'Everyday Fresh & Clean with Our Products', image: onion, bgcolor: '#F0E8D5', buttonText: 'Shop Now →', buttonColor: '#3BB77E'},
        {id: 2, Description: 'Make your Breakfast Healthy and Easy', image: strawberryJuice, bgcolor: '#F3E8E8', buttonText: 'Shop Now →', buttonColor: '#3BB77E'},
        {id: 3, Description: 'The best Organic Products Online', image: mixed_vegetable, bgcolor: '#E7EAF3', buttonText: 'Shop Now →', buttonColor: '#FDC040'},
      ]

    };
  },

  methods: {
    async fetchCategories() {
        try {
            const response = await axios.get('http://localhost:3000/api/categories');
            this.products = response.data;
        } catch (error) {
            console.error('Error fetching categories:', error);
        }
    },

    async fetchPromotions() {
        try {
            const response = await axios.get('http://localhost:3000/api/promotions');
            this.promotions = response.data;
        } catch (error) {
            console.error('Error fetching promotions:', error);
        }
    }
},
  mounted() {
      // Mounted life cycle - It will be executed every time
      // this component is loaded
      this.fetchCategories();
      this.fetchPromotions();
  }
};

</script>

<style scoped>

.listContainer {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  margin-top: 10%;
}

.categoryList {
  display: flex;
  flex-wrap: nowrap;
  gap: 10px;
  padding: 0 0.5rem;
  justify-content: flex-start;
}

.secondContainer {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  margin: 50px 0px;
}

.promotionList {
  display: flex;
  flex-wrap: nowrap;
  gap: 30px;
  padding: 0 0.5rem;
}
</style> -->
<template>

    <div class="NavBar1Container">
      <NavigationBar1
      title="Featured Categories"
      :links="['Milks & Dairies', 'Coffee & Teas', 'Pet Foods', 'Meats', 'Vegetables', 'Fruits']"
      allText="All"
    />
    </div>
    <div class="listContainer">
      <div class="categoryList">
        <CategoryCard
          v-for="product in transformedCategories"
          :key="product.id || product.name"
          :image="product.image"
          :name="product.name"
          :quantity="product.quantity"
          :bgColor="product.bgColor"
          :borderColor="product.borderColor"
        />
      </div>
    </div>

    <div class="secondContainer">
      <div class="promotionList">
        <PromotionCard
          v-for="promotion in transformedPromotions"
          :key="promotion.id"
          :Description="promotion.Description"
          :image="promotion.image"
          :bgcolor="promotion.bgcolor"
          :buttonText="promotion.buttonText"
          :buttonColor="promotion.buttonColor"
        />
      </div>
    </div>
    <div class="NavBar2Container">
      <NavigationBar2
      title="Popular Products"
      :links="['Milks & Dairies', 'Coffee & Teas', 'Pet Foods', 'Meats', 'Vegetables', 'Fruits']"
      allText="All"
    />
    </div>
</template>

<script lang="ts">
import axios from 'axios';
import CategoryCard from './components/Category.vue';
import PromotionCard from './components/Promotion.vue';
import NavigationBar1 from './components/NavigationBar.vue';
import NavigationBar2 from './components/NavigationBar.vue';

// Import images
import Hamburger from '@/assets/Hamburger.png';
import Peach from '@/assets/Peach.png';
import Kiwi from '@/assets/Kiwi.png';
import Apple from '@/assets/Apple.png';
import Snack from '@/assets/Snack.png';
import BlackPlum from '@/assets/BlueBerry.png';
import Vegetable from '@/assets/Vegetable.png';
import Headphone from '@/assets/Headphones.png';
import Cake from '@/assets/Cake.png';
import Orange from '@/assets/Orange.png';

import onion from '@/assets/onion.png';
import strawberryJuice from '@/assets/strawberry-juice.png';
import mixed_vegetable from '@/assets/mixed-vegetable.png';


export default {
  name: 'App',
  components: {
    CategoryCard,
    PromotionCard,
    NavigationBar1,
    NavigationBar2
  },

  data() {
    return {
      rawCategories: [],
      rawPromotions: [],

      // Fallback data (your original hardcoded data)
      fallbackCategories: [
        {id: 1, image: Hamburger, name: 'Cake & Milk', quantity: '14 Items', bgColor: '#F2FCE4', borderColor: '#81B13D'},
        {id: 2, image: Peach, name: 'Peach', quantity: '17 Items', bgColor: '#FFFCEB', borderColor: '#81B13D'},
        {id: 3, image: Kiwi, name: 'Organic Kiwi', quantity: '12 Items', bgColor: '#ECFFEC', borderColor: '#81B13D'},
        {id: 4, image: Apple, name: 'Red Apple', quantity: '20 Items', bgColor: '#FEEFEA', borderColor: '#81B13D'},
        {id: 5, image: Snack, name: 'Snack', quantity: '10 Items', bgColor: '#FFF3EB', borderColor: '#81B13D'},
        {id: 6, image: BlackPlum, name: 'Black Plum', quantity: '8 Items', bgColor: '#FFF3FF', borderColor: '#81B13D'},
        {id: 7, image: Vegetable, name: 'Vegetable', quantity: '15 Items', bgColor: '#F2FCE4', borderColor: '#81B13D'},
        {id: 8, image: Headphone, name: 'Headphone', quantity: '9 Items', bgColor: '#FFFCEB', borderColor: '#81B13D'},
        {id: 9, image: Cake, name: 'Cake', quantity: '11 Items', bgColor: '#F2FCE4', borderColor: '#81B13D'},
        {id: 10, image: Orange, name: 'Orange', quantity: '13 Items', bgColor: '#FFF3FF', borderColor: '#81B13D'},
      ],

      fallbackPromotions: [
        {id: 1, Description: 'Everyday Fresh & Clean with Our Products', image: onion, bgcolor: '#F0E8D5', buttonText: 'Shop Now →', buttonColor: '#3BB77E'},
        {id: 2, Description: 'Make your Breakfast Healthy and Easy', image: strawberryJuice, bgcolor: '#F3E8E8', buttonText: 'Shop Now →', buttonColor: '#3BB77E'},
        {id: 3, Description: 'The best Organic Products Online', image: mixed_vegetable, bgcolor: '#E7EAF3', buttonText: 'Shop Now →', buttonColor: '#FDC040'},
      ]
    };
  },

  computed: {
    // Transform API categories to match component format
    transformedCategories() {
      if (this.rawCategories.length > 0) {
        return this.rawCategories.map(category => ({
          id: category.id,
          image: this.getImageUrl(category.image),
          name: category.name,
          quantity: category.productCount ? `${category.productCount} Items` : '0 Items',
          bgColor: category.color || '#F2FCE4',
          borderColor: '#81B13D'
        }));
      }
      return this.fallbackCategories;
    },

    // Transform API promotions to match component format
    transformedPromotions() {
      if (this.rawPromotions.length > 0) {
        return this.rawPromotions.map(promotion => ({
          id: promotion.id,
          Description: promotion.description || promotion.Description || 'Promotion Description',
          image: this.getImageUrl(promotion.image),
          bgcolor: promotion.backgroundColor || promotion.color || '#F0E8D5',
          buttonText: 'Shop Now →',
          buttonColor: '#3BB77E'
        }));
      }
      return this.fallbackPromotions;
    }
  },

  methods: {
    // Convert backend file path to full URL - FIXED for Windows paths
    getImageUrl(imagePath: string): string {
      if (!imagePath) return '';
      if (imagePath.startsWith('http')) return imagePath;

      // Fix Windows backslashes
      const cleanPath = imagePath.replace(/\\/g, '/').trim();

      // If it's an uploaded file from backend → prepend the backend URL
      if (cleanPath.startsWith('uploads/')) {
        return `http://localhost:3000/${cleanPath}`;
      }

      // If it's still a local asset like '@/assets/xxx.png' (your fallback)
      if (cleanPath.startsWith('@/assets/')) {
        return cleanPath;
      }

      // Fallback: assume it's from backend
      return `http://localhost:3000/${cleanPath}`;
    },

    // ========== CATEGORY OPERATIONS ==========

    // GET - Fetch categories from API
    async fetchCategories() {
      try {
        const response = await axios.get('http://localhost:3000/api/categories');
        this.rawCategories = response.data;
        console.log('Categories updated automatically');
      } catch (error) {
        console.error('Error fetching categories:', error);
        this.rawCategories = [];
      }
    },

    // POST - Add new category
    async addCategory(categoryData: any) {
      try {
        // Use backend format (from your Postman)
        const backendFormatData = {
          name: categoryData.name,
          productCount: categoryData.productCount || 0,
          color: categoryData.color || '#F2FCE4',
          image: categoryData.image || 'uploads/category/default.png'
        };

        const response = await axios.post('http://localhost:3000/api/categories', backendFormatData);

        // Auto-refresh to show the new data
        await this.fetchCategories();

        console.log('Category added and data refreshed automatically');
        return response.data;
      } catch (error) {
        console.error('Error adding category:', error);
        throw error;
      }
    },

    // DELETE - Remove category
    async deleteCategory(categoryId: number) {
      try {
        await axios.delete(`http://localhost:3000/api/categories/${categoryId}`);

        // Auto-refresh to show updated data
        await this.fetchCategories();

        console.log('Category deleted and data refreshed automatically');
      } catch (error) {
        console.error('Error deleting category:', error);
        throw error;
      }
    },

    // PATCH - Update category
    async updateCategory(categoryId: number, updateData: any) {
      try {
        const response = await axios.patch(   // ← changed from .put to .patch
          `http://localhost:3000/api/categories/${categoryId}`,
          updateData
        );

        await this.fetchCategories();
        console.log('Category updated and refreshed');
        return response.data;
      } catch (error) {
        console.error('Error updating category:', error);
        throw error;
      }
    },

    // ========== PROMOTION OPERATIONS ==========

    // GET - Fetch promotions from API
    async fetchPromotions() {
      try {
        const response = await axios.get('http://localhost:3000/api/promotions');
        this.rawPromotions = response.data;
        console.log('Promotions updated automatically');
      } catch (error) {
        console.error('Error fetching promotions:', error);
        this.rawPromotions = [];
      }
    },

    // POST - Add new promotion
    async addPromotion(promotionData: any) {
      try {
        // Use backend format
        const backendFormatData = {
          description: promotionData.description,
          backgroundColor: promotionData.backgroundColor || '#F0E8D5',
          image: promotionData.image || 'uploads/promotion/default.png'
        };

        const response = await axios.post('http://localhost:3000/api/promotions', backendFormatData);

        // Auto-refresh to show the new data
        await this.fetchPromotions();

        console.log('Promotion added and data refreshed automatically');
        return response.data;
      } catch (error) {
        console.error('Error adding promotion:', error);
        throw error;
      }
    },

    // DELETE - Remove promotion
    async deletePromotion(promotionId: number) {
      try {
        await axios.delete(`http://localhost:3000/api/promotions/${promotionId}`);

        // Auto-refresh to show updated data
        await this.fetchPromotions();

        console.log('Promotion deleted and data refreshed automatically');
      } catch (error) {
        console.error('Error deleting promotion:', error);
        throw error;
      }
    },

    // Auto-refresh data periodically (like real apps)
    startAutoRefresh() {
      // Refresh every 30 seconds to get latest data
      setInterval(() => {
        this.fetchCategories();
        this.fetchPromotions();
      }, 30000); // 30 seconds
    }
  },

  mounted() {
    // Load data immediately when page loads
    this.fetchCategories();
    this.fetchPromotions();

    // Start automatic refreshing
    this.startAutoRefresh();
  }
};
</script>

<style scoped>
.listContainer {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  margin-top: 3%;
}

.categoryList {
  display: flex;
  flex-wrap: nowrap;
  gap: 10px;
  padding: 0 0.5rem;
  justify-content: flex-start;
}

.secondContainer {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  margin: 70px 0px;
}

.promotionList {
  display: flex;
  flex-wrap: nowrap;
  gap: 30px;
  padding: 0 0.5rem;
  margin-bottom: 0;
}

</style>
