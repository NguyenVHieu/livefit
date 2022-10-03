<template>
  <div :style="{ marginTop: '80px' }">
    <Slider
      :item="productDetail[0]"
      :type="{ id: productDetail[0].id, styles: 'SlideDetail' }"
    />
    <ProductDetail :item="productDetail[0]" />
    <div class="container" :style="{ marginTop: '132px' }">
      <div class="content-title">
        <span>{{ productDetail[0].sub_title }}</span>
      </div>
      <div class="workout-params">
        <div>
          <div class="workout-params__item">
            <feather-icon
              class="workout-params__icon"
              icon="PackageIcon"
              :style="{ color: '#678eeb' }"
            />
            <span>{{ productDetail[0].category2 }}</span>
          </div>
          <div class="workout-params__item">
            <feather-icon
              class="workout-params__icon"
              icon="CopyIcon"
              :style="{ color: '#ed716d' }"
            />
            <span>Get toned, Lose fat</span>
          </div>
        </div>
        <div>
          <div class="workout-params__item">
            <feather-icon
              class="workout-params__icon"
              icon="CalendarIcon"
              :style="{ color: '#5fbb74' }"
            />
            <span>{{ productDetail[0].time }} Week</span>
          </div>
          <div class="workout-params__item">
            <feather-icon
              class="workout-params__icon"
              icon="ClockIcon"
              :style="{ color: '#f19d4b' }"
            />
            <san>10-58 minute workouts</san>
          </div>
        </div>
      </div>
      <Guide />
      <div class="workout-image">
        <img src="../assets/images/guide/guide1.jpg" alt="" />

        <p class="workout-sub">
          This training plan consists of easy-to-follow visual workouts, which
          you can print or access on any device
        </p>
        <b-button
          class="btn-view-workout"
          variant="gradient-success"
          @click="onViewWorkout"
          >VIEW SAMPLE WORKOUT</b-button
        >
        <div v-if="isShow" :style="{ marginTop: '20px' }">
          <a class="plan-item" href="/workout-sample"> Gói tập 1 </a>
          <a class="plan-item" href="/workout-sample"> Gói tập 2 </a>
          <a class="plan-item" href="/workout-sample"> Gói tập 3 </a>
        </div>
      </div>
      <div class="list-product-similar">
        <h3 :style="{ margin: '50px 0 30px 18px' }">
          You might like these too
        </h3>
        <div class="row">
          <Product
            v-for="(item, index) in productSimilar"
            :key="index"
            :item="item"
            :style="{ marginBottom: '50px' }"
          />
        </div>
        <a href="/workout" :style="{ display: 'block' }">
          <b-button variant="gradient-success" class="btn-workout"
            >VIEW ALL WORKOUTS
            <feather-icon icon="ArrowLeftIcon" class="icon-workout" />
          </b-button>
        </a>

        <div class="footer-content">
          <img
            class="logo"
            src="../assets/images/logo/logo_gym.webp"
            alt="logo-lỗi"
          />
          <span :style="{ margin: '0 20px' }">OUR SHOP</span>
          <span>CONTACT</span>
        </div>
      </div>
    </div>
    <Footer />
  </div>
</template>
<script>
import Slider from "../layouts/components/Slider.vue";
import ProductDetail from "../layouts/components/ProductDetail.vue";
import Guide from "../layouts/components/Guide.vue";
import Product from "../layouts/components/Product.vue";
import Footer from "../layouts/components/Footer.vue";
export default {
  components: {
    Slider,
    ProductDetail,
    Guide,
    Product,
    Footer,
  },
  data() {
    return {
      productDetail: {},
      productSimilar: [],
      isShow: false,
    };
  },
  created() {
    this.productDetail = this.$store.state.products.listProduct.filter(
      (product) => product.id == this.$route.params.id
    );
    this.productSimilar = this.$store.state.products.listProduct.filter(
      (product) => product.category == this.productDetail[0].category
    );
  },
  methods: {
    onViewWorkout() {
      this.isShow = !this.isShow;
    },
  },
};
</script>
<style lang="css" scoped>
.container {
}
.content-title {
  max-width: 680px;
  text-align: center;
  margin: 40px 0 40px 214px;
  font-size: 26px;
  line-height: 32px;
  letter-spacing: -0.4px;
  text-align: center;
}
.workout-params {
  display: flex;
  justify-content: space-evenly;
  align-items: center;
  font-size: 20px;
  font-weight: 500;
  text-transform: uppercase;
}
.workout-params__item {
  margin-bottom: 20px;
}
.workout-params__icon {
  width: 42px;
  height: 42px;
  margin-right: 20px;
}
.workout-image {
  margin-top: 50px;
  margin-left: 50%;
  transform: translateX(-50%);
  display: flex;
  flex-direction: column;
  align-items: center;
}
.workout-image img {
  width: 500px;
  height: 333px;
}
.workout-sub {
  margin-top: 20px;
  font-size: 18px;
  text-align: center;
}

.btn-workout {
  color: #fff;
  padding: 10px 32px;
  margin-left: 37%;
  font-size: 18px;
  font-weight: 800;
}
.btn-view-workout {
  padding: 10px 25px;
  color: #fff;
  font-weight: bold;
  font-size: 18px;
  display: block;
}
.plan-item {
  display: block;
  font-size: 18px;
  color: var(--primary);
}
.plan-item:hover {
  color: var(--primary);
  text-decoration: underline;
}
.icon-workout {
  width: 16px;
  height: 28px;
  margin-left: 8px;
}
.footer-content {
  font-size: 11px;
  font-weight: 500;
  margin: 50px 0;
}
.logo {
  width: 40px;
  height: 40px;
}
</style>