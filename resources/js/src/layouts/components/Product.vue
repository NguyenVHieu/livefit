<template>
  <div
    class="container col-4"
    :class="{ 'col-6': type == 'profile', 'col-4': type != 'profile' }"
    :style="{
      backgroundImage: `url(
        ${item.image}
      )`,
    }"
    @mouseover="onMouseItem"
    @mouseleave="onLeaveItem"
  >
    <div class="ticker" v-if="item.popular">
      <span>POPULAR</span>
    </div>
    <h3 class="title" :class="{ title1: isCheck }">{{ item.title }}</h3>
    <span
      v-if="isCheck2"
      class="sub-title"
      :class="{
        red: item.color == 'red',
        blue: item.color == 'blue',
        green: item.color == 'green',
      }"
      >{{ item.title2 }}</span
    >
    <span v-if="isCheck" class="sub-title2">{{ item.sub_title }}</span>
    <b-button variant="gradient-success" class="btn btn-success" v-if="isCheck">
      <a
        :href="`/workout/${item.id}`"
        :style="{ textDecoration: 'none', color: '#fff' }"
        >View plan</a
      >
    </b-button>
    <div v-if="isCheck2">
      <span class="time-number">{{ item.time }}</span>
      <div class="d-flex footer-item">
        <span class="footer-item_1">{{ item.category2 }}</span>
        <span class="footer-item_2" v-if="item.mini == false">week</span>
        <span class="footer-item_2" v-else-if="item.mini == true">minutes</span>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "ProductView",
  data() {
    return {
      isCheck: false,
      isCheck2: true,
    };
  },
  props: {
    item: {
      type: Object,
      required: true,
    },
    type: {
      type: String,
      required: false,
    },
  },
  methods: {
    onMouseItem() {
      this.isCheck = true;
      this.isCheck2 = false;
    },
    onLeaveItem() {
      this.isCheck = false;
      this.isCheck2 = true;
    },
  },
};
</script>
<style lang="css" scoped>
.container {
  cursor: pointer;
  background-repeat: no-repeat;
  background-size: cover;
  background-blend-mode: darken;
  max-width: 316px;
  height: 320px;
  text-align: center;
  border-radius: 16px;
  box-shadow: 1px 2px 8px #888888;
  background-color: rgba(0, 0, 0, 0.3);
}
.ticker {
  position: absolute;
  background-color: #7f19e4;
  color: #fff;
  width: 100px;
  height: 30px;
  right: -14px;
  top: 14px;
}
.ticker > span {
  line-height: 28px;
  font-weight: bold;
}
.title {
  color: #fff;
  font-size: 26px;
  font-weight: 900;
  margin: 98px auto 0;
  text-align: center;
  line-height: 32px;
  letter-spacing: -0.5px;
  text-decoration: none;
  display: block;
  position: relative;
}
.title1 {
  font-size: 18px !important;
  margin-top: 40px;
}
.sub-title {
  position: absolute;
  font-size: 12px;
  color: #fff;
  display: block;
  text-align: center;
  padding: 4px 9px;
  text-transform: uppercase;
  border-radius: 100px;
  font-weight: 700;
  margin: 20px 100px;
}
.sub-title2 {
  font-size: 16px;
  color: #fff;
}
.footer-item {
  justify-content: space-between;
  text-transform: uppercase;
  color: #fff;
  opacity: 0.65;
  font-size: 16px;
  font-weight: 600;
}
.footer-item_2,
.footer-item_1 {
  position: absolute;
  bottom: 25px;
  line-height: 18px;
  letter-spacing: -0.3px;
}
.footer-item_1 {
  left: 30px;
}
.footer-item_2 {
  right: 30px;
}
.time-number {
  font-size: 35px;
  color: #fff;
  opacity: 0.65;
  font-weight: bold;
  position: absolute;
  right: 39px;
  bottom: 36px;
}
.btn-success {
  display: block;
  padding: 10px 20px;
  margin-top: 32px;
  font-weight: bold;
  margin-left: 90px;
  text-transform: uppercase;
}
.btn-success:hover {
  box-shadow: none !important;
}
.red {
  background-color: red;
}
.blue {
  background-color: blue;
}
.green {
  background-color: var(--primary);
}
</style>
