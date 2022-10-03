<template>
  <div class="header">
    <div class="header-process">
      <div
        v-for="(item, idx) in listProcess"
        :key="idx"
        class="header-process_item"
        :class="{ active: item.processing }"
      ></div>
    </div>
    <div class="process">
      <span :style="{ fontSize: '20px' }"
        >{{ minutes >= 10 ? minutes : "0" + minutes }}:{{
          seconds >= 10 ? seconds : "0" + seconds
        }}</span
      >
      <feather-icon class="icon-volume" icon="Volume2Icon" />
    </div>
  </div>
</template>
<script>
export default {
  props: {
    listProcess: {
      type: Array,
      required: true,
    },
    totalTime: {
      type: Number,
      required: false,
    },
  },
  data() {
    return {
      minutes: 0,
      seconds: 0,
    };
  },
  computed: {
    coutDownMinutes() {
      return Math.floor(this.totalTime / 60);
    },
    coutDownSeconds() {
      return this.totalTime % 60;
    },
  },
  watch: {
    coutDownMinutes(newVal) {
      this.minutes = newVal;
    },
    coutDownSeconds(newVal) {
      this.seconds = newVal;
    },
  },
};
</script> 
<style lang="css" scoped>
.header {
  margin: 24px 200px;
  position: fixed;
  z-index: 12;
  top: 0;
  left: 0;
  right: 0;
}
.header-process {
  display: flex;
  align-items: center;
  justify-content: center;
}
.header-process_item {
  width: 100px;
  height: 8px;
  background-color: #c3c3c338;
  border-radius: 4px;
  margin: 0 4px;
}
.process {
  display: flex;
  justify-content: flex-end;
  align-items: center;
}
.icon-volume {
  cursor: pointer;
  margin-left: 40px;
  width: 40px;
  height: 40px;
}
.active {
  background-color: var(--primary);
}
</style>