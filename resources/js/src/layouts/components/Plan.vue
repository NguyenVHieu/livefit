<template>
  <div class="col-4 d-flex" :style="{ marginBottom: '20px' }">
    <div
      class="content-plan"
      :class="{ 'chose-close': isCheckClose }"
      draggable="true"
      @mouseover="onMouseOver"
      @mouseleave="onMouseLeave"
      @dragstart="startDrag($event, index)"
      @drop="onDrog($event, index)"
      @dragover.prevent
      @dragenter.prevent
    >
      <h5 :style="{ color: '#000' }">{{ item.describe || item.title }}</h5>
      <img :src="item.image" :style="{ marginTop: '20px' }" />
      <div
        class="descrion"
        v-if="item.time.sets != null"
        @click="onClickDetail(item)"
      >
        <span class="descrion-item">
          <h5>{{ item.time.sets }}</h5>
          sets
        </span>
        <span v-if="item.time.reps" class="descrion-item">
          <h5>{{ item.time.reps }}</h5>
          reps
        </span>
        <span class="descrion-item">
          <h5>{{ item.time.sec }}</h5>
          sec rest
        </span>
      </div>
      <p
        v-if="item.time.sets == null"
        class="add-detail"
        @click="onClickDetail(item)"
      >
        Add detail
      </p>
      <div v-if="isCheck" class="nav-bar">
        <feather-icon
          icon="XIcon"
          class="nav-bar__icon"
          :class="{ close: isCheckClose }"
          @click="onRemovePlan"
          @mouseover="onMouseClose"
          @mouseleave="onMouseNotClose"
        />
        <feather-icon
          icon="InfoIcon"
          class="nav-bar__icon"
          @click="onShawInfor"
        />
        <feather-icon icon="CopyIcon" class="nav-bar__icon" />
      </div>
    </div>
    <div>
      <div class="sctrollbar"></div>
      <div class="sctrollbar-time">
        <feather-icon icon="ChevronUpIcon" />
        <span>1:30</span>
        <feather-icon icon="ChevronDownIcon" />
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    item: {
      type: Object,
      required: true,
    },
    index: {
      type: Number,
      required: false,
    },
  },
  data() {
    return {
      isCheck: false,
      isCheckClose: false,
    };
  },
  methods: {
    onMouseOver() {
      this.isCheck = true;
    },
    onMouseLeave() {
      this.isCheck = false;
    },
    onRemovePlan() {
      this.$emit("removePlan");
    },
    onMouseClose() {
      this.isCheckClose = true;
    },
    onMouseNotClose() {
      this.isCheckClose = false;
    },
    onShawInfor() {
      this.$emit("showInfor");
    },
    onClickDetail(item) {
      this.$emit("detail", item);
    },
    startDrag(event, index) {
      event.dataTransfer.dropEffect = "move";
      event.dataTransfer.effectAllowed = "move";
      event.dataTransfer.setData("itemID", index);
    },
    onDrog(event, index) {
      const itemID = event.dataTransfer.getData("itemID");
      this.$emit("dragDrop", itemID, index);
    },
  },
};
</script>
<style lang="css" scoped>
.content-plan {
  position: relative;
  cursor: pointer;
  background-color: #fff;
  width: 240px;
  height: 260px;
  box-shadow: 0px 6px 12px 0px rgb(2 2 2 / 10%);
  border: 3px solid #fff;
  border-radius: 8px;
  padding: 10px;
  overflow: hidden;
}
.descrion {
  display: flex;
  margin-top: 20px;
  justify-content: space-around;
}
.descrion:hover {
  color: var(--blue);
}
.descrion-item {
  display: flex;
  align-items: center;
}
.nav-bar {
  display: flex;
  flex-direction: column;
  justify-content: space-evenly;
  position: absolute;
  right: 0;
  top: 0;
  padding: 10px;
  /* background-color: rgb(234, 228, 228); */
  animation: example 0.1s linear;
}
.nav-bar__icon {
  width: 16px;
  height: 16px;
  margin: 6px 0;
}
.nav-bar__icon:hover {
  color: var(--primary);
}
.chose-close {
  border: 2px solid red;
}
.close:hover {
  color: red;
}
.sctrollbar {
  width: 6px;
  height: 80%;
  position: relative;
  left: 35px;
  top: 24px;
  background-color: #b7b3b324;
}
.sctrollbar-time {
  cursor: pointer;
  position: absolute;
  top: 38%;
  right: 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 50px;
  height: 50px;
  background-color: #fff;
  border-radius: 8px;
  font-size: 20px;
  font-weight: 600;
  box-shadow: 0px 6px 12px 0px rgb(2 2 2 / 10%);
}
.add-detail {
  text-align: center;
  margin: 10px 0;
}
.add-detail:hover {
  color: var(--blue);
}
h5 {
  margin: 0;
  margin-right: 6px;
}

@keyframes example {
  from {
    right: -4px;
  }
  to {
    right: 0;
  }
}
</style>