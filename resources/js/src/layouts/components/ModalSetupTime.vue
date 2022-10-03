<template>
  <div class="modal-detail">
    <div class="container-detail">
      <div class="header">
        <h3>{{ item.describe || item.title }}</h3>
        <feather-icon class="icon" icon="XIcon" @click="onClose" />
      </div>
      <div class="content-detail">
        <div class="content-detail-value">
          <div>
            <input
              type="number"
              class="input-value"
              v-model="inputValue.sets"
            />
            <label class="sup-value">sets</label>
          </div>
          <div>
            <input
              type="number"
              class="input-value"
              v-model="inputValue.reps"
            />
            <label class="sup-value">reps</label>
          </div>
          <div>
            <input class="input-value" v-model="inputValue.second" />
            <label class="sup-value">second</label>
          </div>
        </div>
        <input class="input-text" type="number" :value="text" />
        <div class="footer-detail">
          <div class="d-flex">
            <p>Show this when adding exercises</p>
            <feather-icon
              v-if="isShowLeft"
              class="icon-toggle"
              icon="ToggleLeftIcon"
              @click="onClickIcon('left')"
            />
            <feather-icon
              v-if="isShowRight"
              class="icon-toggle"
              icon="ToggleRightIcon"
              :style="{ color: 'var(--primary)' }"
              @click="onClickIcon('right')"
            />
          </div>
          <b-button
            class="btn-save"
            variant="gradient-success"
            @click="onSave(item.id)"
            >Save</b-button
          >
        </div>
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
  },
  data() {
    return {
      inputValue: {
        sets: this.item.time.sets,
        reps: this.item.time.reps,
        second: this.item.time.sec,
        id: null,
        type: null,
      },
      text: "Feel like Arnie!",
      isShowRight: false,
      isShowLeft: true,
    };
  },
  methods: {
    onClose() {
      this.$emit("closeModal");
    },
    onClickIcon(type) {
      if (type == "left") {
        this.isShowRight = true;
        this.isShowLeft = false;
      } else {
        this.isShowRight = false;
        this.isShowLeft = true;
      }
    },
    onSave(id) {
      this.inputValue.id = id;
      this.inputValue.type = this.item.type;
      this.$store.dispatch("plans/addTime", { payload: this.inputValue });
      this.$emit("closeModal");
    },
  },
};
</script>
<style lang="css" scoped>
.modal-detail {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 12;
  background-color: rgba(0, 0, 0, 0.5);
}
.container-detail {
  position: absolute;
  bottom: 32%;
  margin-left: 38%;
  transform: translateX(-50%);
  background-color: #fff;
  width: 600px;
  border-radius: 16px;
  animation: example 0.5s linear;
}
.header {
  display: flex;
  justify-content: space-between;
  padding: 16px;
}
.content-detail {
  margin-top: 50px;
  padding: 30px 40px;
  background-color: #fdfdfd;
}
.content-detail-value {
  justify-content: space-around;
  display: flex;
}
.input-value {
  width: 60px;
  height: 60px;
  text-align: center;
  font-size: 24px;
  border-radius: 4px;
}
.input-text:focus,
.input-value:focus {
  border: 3px solid var(--blue);
  outline: none;
}
.input-text {
  width: 100%;
  height: 70px;
  font-size: 16px;
  padding: 0 20px;
  margin-top: 23px;
  border-radius: 4px;
}

.sup-value {
  font-size: 20px;
  margin-left: 10px;
}
.icon {
  width: 26px;
  height: 26px;
  opacity: 0.5;
}
.icon:hover {
  opacity: 1;
  cursor: pointer;
}
.footer-detail {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 18px;
  margin-top: 30px;
}
.btn-save {
  padding: 10px 30px;
  color: #fff;
  /* font-size: 18px; */
  font-weight: 600;
}
.icon-toggle {
  margin-left: 20px;
  width: 40px;
  height: 26px;
  cursor: pointer;
}
@keyframes example {
  from {
    bottom: -10px;
  }
  to {
    bottom: 32%;
  }
}
</style>