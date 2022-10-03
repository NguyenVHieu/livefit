<template>
  <div
    class="container"
    draggable="true"
    @mouseover="onMouseOver"
    @mouseleave="onMouseLeave"
    @dragstart="startDrag($event, index)"
    @dragover.prevent
    @dragenter.prevent
  >
    <h3 class="title" :class="{ 'title-active': isCheck }">{{ item.title }}</h3>
    <img class="image" :src="item.image" />
    <feather-icon class="icon-infor" icon="InfoIcon" @click="onClickInfor" />
    <feather-icon
      v-if="isCheck"
      class="icon-star"
      :class="{ active: isActive }"
      icon="StarIcon"
      @click="onClickStar"
    />
    <feather-icon
      v-if="isCheck"
      icon="PlusIcon"
      class="icon-plus"
      @click="onAddPlan(item)"
    />
  </div>
</template>
<script>
export default {
  data() {
    return {
      isCheck: false,
      isActive: false,
    };
  },
  props: {
    item: {
      type: Object,
      required: true,
    },
    index: {
      type: Number,
      required: true,
    },
  },
  methods: {
    onMouseOver() {
      this.isCheck = true;
    },
    onMouseLeave() {
      this.isCheck = false;
    },
    onClickInfor() {
      this.$emit("showInfor");
    },
    onClickStar() {
      this.isActive = true;
    },
    onAddPlan(item) {
      this.$emit("addPlan", item);
    },
    startDrag(event, index) {
      event.dataTransfer.dropEffect = "move";
      event.dataTransfer.effectAllowed = "move";
      event.dataTransfer.setData("planSearch", index);
      this.$emit("drag", index);
    },
  },
};
</script>
<style lang="css" scoped>
.container {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 20px;
}
.title {
  font-size: 18px;
}
.image {
  width: 200px;
  height: 200px;
}
.icon-infor,
.icon-star,
.icon-plus {
  cursor: pointer;
  position: absolute;
  width: 26px;
  height: 26px;
  right: 20px;
}
.icon-infor {
  top: 0;
  right: 12px;
  opacity: 0.5;
}
.icon-plus:hover,
.icon-infor:hover {
  color: var(--primary);
}
.icon-star {
  top: 50%;
}
.icon-star:hover {
  color: gold;
}
.icon-plus {
  bottom: 20px;
}
.title-active {
  color: var(--primary);
}
.active {
  color: gold;
}
</style>