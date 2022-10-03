<template>
  <div :style="{ marginTop: '80px' }">
    <b-carousel
      id="carousel-1"
      class="list-slider"
      v-model="slide"
      :interval="4000"
      controls
      indicators
      background="#ababab"
      img-width="1024"
      img-height="480"
      style="text-shadow: 1px 1px 2px #333"
      @sliding-start="onSlideStart"
      @sliding-end="onSlideEnd"
    >
      <!-- Text slides with image -->
      <b-carousel-slide
        class="slide-item"
        v-for="(item, index) in rederSlider"
        :key="index"
        :style="{ background: `url(${item.image})` }"
        :class="{
          backgroundColor1: index == 0,
          backgroundColor2: index == 1,
          backgroundColor3: index == 2,
          backgroundColor4: index == 3,
          backgroundColor5: index == 4,
          backgroundColor6: index == 5,
          backgroundColor7: index == 6,
        }"
      >
        <div
          class="d-flex"
          v-if="type.styles == 'workoutPage'"
          :style="{ justifyContent: 'space-around' }"
        >
          <div class="text-content">
            <h3 class="title">{{ item.title }}</h3>
            <p class="sub-title">{{ item.sub_title }}</p>
            <a
              :href="`/workout/${item.id}`"
              :style="{
                display: 'block',
                position: 'absolute',
                bottom: '30px',
              }"
            >
              <b-button
                variant="success"
                class="btn-succcess"
                :class="{ gray: index % 2 == 0, orange: index % 3 == 0 }"
                >VIEW PLAN</b-button
              >
            </a>
          </div>
          <Product :item="item" class="image-item" />
        </div>
      </b-carousel-slide>
    </b-carousel>
  </div>
</template>

<script>
import Product from "./Product.vue";
export default {
  props: {
    type: {
      type: String,
      required: false,
    },
  },
  components: {
    Product,
  },
  data() {
    return {
      slide: 0,
      sliding: null,
    };
  },
  methods: {
    onSlideStart(slide) {
      this.sliding = true;
    },
    onSlideEnd(slide) {
      this.sliding = false;
    },
  },
  computed: {
    rederSlider() {
      if (this.type.styles == "SlideDetail") {
        return this.$store.state.products.listProduct.filter(
          (product) => product.id == this.type.id
        );
      } else {
        return this.$store.state.products.listProduct.slice(0, 7);
      }
    },
  },
};
</script>
<style lang="css" scoped>
.list-slider {
  width: 100%;
}

.slide-item {
  position: relative;
  background-repeat: no-repeat !important;
  background-size: cover !important;
  background-position: 0 -200px;
  background-blend-mode: darken;
  height: 460px;
  width: 100%;
}
.text-content {
  position: relative;
  max-width: 450px;
  top: 42px;
  text-align: left;
}
.title {
  font-size: 46px;
  color: #fff;
  font-weight: 900;
  letter-spacing: -1px;
  line-height: 52px;
  text-decoration: none;
  display: block;
}
.sub-title {
  font-size: 17px;
  color: #fff;
  font-weight: 400;
  margin-top: 15px;
  line-height: 25px;
  letter-spacing: -0.7px;
}
.btn-succcess {
  padding: 12px 50px;
  margin-top: 20px;
  border: none;
  font-weight: bold;
}
.btn-succcess:hover {
  box-shadow: none !important;
}

.image-item {
  box-shadow: none;
}
.backgroundColor1 {
  background-color: #c80436 !important;
}
.backgroundColor2 {
  background-color: #7a45e5 !important;
}
.backgroundColor3 {
  background-color: #5c69f2 !important;
}
.backgroundColor4 {
  background-color: #3f4449 !important;
}
.backgroundColor5 {
  background-color: #e58422 !important;
}
.backgroundColor6 {
  background-color: #3f4449 !important;
}
.backgroundColor7 {
  background-color: #716bb3 !important;
}
.gray {
  background-color: #ccc !important;
}
.orange {
  background-color: orange !important;
}
</style>