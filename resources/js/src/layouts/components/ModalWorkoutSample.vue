<template>
  <div class="container-model">
    <div class="content-model">
      <feather-icon class="icon" @click="onCloseModal" icon="XIcon" />
      <h3 class="heading">Swap that with...</h3>
      <div
        class="wrapper"
        v-for="(item, idx) in data"
        :key="idx"
        @click="onClickSample(item)"
      >
        <img class="image" :src="item.image" />
        <span class="title">{{ item.title }}</span>
      </div>
      <button class="btn-cancel" @click="onCloseModal">Cancel</button>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    data: {
      type: Array,
      required: true,
    },
  },
  methods: {
    onCloseModal() {
      this.$emit("closeModal");
    },
    onClickSample(item) {
      this.$emit("ClickSample", item);
      this.$emit("closeModal");
    },
  },
};
</script>
<style lang="css" scoped>
.container-model {
  position: fixed;
  z-index: 12;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
}
.content-model {
  position: absolute;
  background-color: #fff;
  width: 415px;
  top: 100px;
  left: 50%;
  transform: translate(-50%);
  border-radius: 8px;
  padding: 10px 20px;
  animation: example linear 0.3s;
}
.heading {
  text-align: center;
  color: #000;
  font-weight: 800;
  margin: 20px 0;
}
.icon {
  position: absolute;
  right: 10px;
  top: 10px;
  cursor: pointer;
  width: 20px;
  height: 20px;
}

.wrapper {
  padding: 0 5px;
  border: solid 1px #ccc;
  border-radius: 6px;
  margin-bottom: 20px;
  cursor: pointer;
}
.btn-cancel:hover,
.wrapper:hover {
  border-color: #000;
}
.image {
  width: 120px;
  height: 120px;
}
.title {
  font-weight: 700;
  font-size: 18px;
}
.btn-cancel {
  width: 100%;
  padding: 10px;
  background-color: transparent;
  color: #000;
  font-size: 18px;
  font-weight: 600;
  border: solid 1px #ccc;
  border-radius: 6px;
}

@keyframes example {
  from {
    top: 50px;
  }
  to {
    top: 100px;
  }
}
</style>