<template>
  <div
    class="container col-4"
    :style="{
      backgroundImage: `url(
        ${item.image}
      )`,
    }"
  >
    <div class="ticker" v-if="item.popular">
      <span>POPULAR</span>
    </div>
    <h3 class="title">{{ item.title }}</h3>
    <span
      class="sub-title"
      :class="{
        red: item.color == 'red',
        blue: item.color == 'blue',
        green: item.color == 'green',
      }"
      >{{ item.title2 }} TRAINING PLAN</span
    >
    <span class="sub-title2"
      >Started by
      <span :style="{ color: 'orange' }">{{ item.members }}</span> users in the
      last month</span
    >
  </div>
</template>
<script>
export default {
  props: {
    item: {
      type: Object,
      required: true,
    },
  },
};
</script>
<style lang="css" scoped>
.container {
  cursor: default;
  position: absolute;
  background-repeat: no-repeat;
  background-size: cover;
  background-blend-mode: darken;
  height: 492px;
  left: 33%;
  top: 130px;
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
  position: absolute;
  color: #fff;
  font-size: 45px;
  font-weight: 900;
  text-align: center;
  letter-spacing: -0.5px;
  text-decoration: none;
  top: 154px;
  padding: 0 40px;
  right: 6px;
}

.sub-title {
  position: absolute;
  font-size: 18px;
  color: #fff;
  display: block;
  text-align: center;
  padding: 8px 25px;
  text-transform: uppercase;
  border-radius: 100px;
  font-weight: 700;
  top: 314px;
  left: 100px;
}
.sub-title2 {
  position: absolute;
  color: #fff;
  bottom: 24px;
  font-size: 21px;
  text-align: center;
  width: 100%;
  left: 0;
  font-weight: 700;
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