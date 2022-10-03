<template>
  <div>
    <Process :listProcess="listProcess" :totalTime="totalTime" />
    <div class="container">
      <div class="content-exercise">
        <h4 class="exercise-title">{{ processItem.describe }}</h4>
        <img class="image" src="../assets/images/process/hinh-gif.gif" />
        <div v-if="!isStart" class="time">
          <div class="time-number">
            <span :style="{ marginRight: '100px' }">{{
              processItem.time.sets
            }}</span>
            <span>{{ processItem.time.sec }}</span>
          </div>
          <div class="time-title">
            <span :style="{ position: 'relative', right: '25px' }">sets</span>
            <span :style="{ position: 'relative', left: '40px' }"
              >sec rest</span
            >
          </div>
        </div>
        <div v-if="isStart">
          <div v-if="isReady" :style="{ marginTop: '10px' }">
            <h3 class="title-ready">Get ready</h3>
            <h3 class="start-time">
              {{ startTime }}
            </h3>
          </div>
          <div v-if="!isReady" :style="{ marginTop: '10px' }">
            <h3
              class="title-ready"
              :style="{ fontSize: '30px', color: '#000', fontWeight: '300' }"
            >
              set 1 of 3
            </h3>
            <span class="sub-title-ready">Reps not set</span>
          </div>
        </div>
        <p class="sub-title">
          To failure. If too difficult, exchange for reverse rows using a bar.
          Can you beat last week?
        </p>
        <div class="infor">
          <feather-icon
            class="icon icon-info"
            icon="InfoIcon"
            @click="onInfo"
          />
          <feather-icon class="icon" icon="ArrowRightIcon" />
        </div>
        <div class="footer-content">
          <button class="action btn-pause" @click="onPause">
            <feather-icon class="icon" icon="PauseIcon" />
          </button>
          <b-button
            v-if="isCheck"
            class="action btn-next"
            variant="gradient-success"
            @click="onStart"
          >
            <span>Start</span>
            <feather-icon class="icon" icon="ArrowRightIcon" />
          </b-button>
          <b-button
            v-if="!isCheck"
            class="action btn-next"
            variant="gradient-success"
            @click="onNext"
          >
            <span>Next</span>
            <feather-icon class="icon" icon="ArrowRightIcon" />
          </b-button>
        </div>
      </div>
    </div>
    <Modal v-if="showModal" @closeModal="onCloseModal" />
    <ModalPause
      v-if="isPause"
      @closeModal="onCloseModalPause"
      :totalTime="totalTime"
    />
  </div>
</template>
<script>
import Process from "../layouts/components/Process.vue";
import Modal from "../layouts/components/Modal.vue";
import ModalPause from "../layouts/components/ModalPauseWorkout.vue";
export default {
  components: {
    Process,
    Modal,
    ModalPause,
  },
  data() {
    return {
      listProcess: [],
      processItem: null,
      showModal: false,
      isPause: false,
      isStart: false,
      isCheck: true,
      intervalId: null,
      startTime: 3,
      isReady: false,
      intervalStarTime: null,
      totalTime: 0,
    };
  },
  created() {
    this.$store.dispatch("header/closeHeader");
    this.$store.dispatch("workout/setProcess", { index: 0 });
    this.listProcess = this.$store.state.workout.listWorkout;
  },
  computed: {
    onSetProcess() {
      return this.listProcess.filter((item) => item.processing == true);
    },
  },
  watch: {
    onSetProcess(newVal) {
      this.processItem = newVal[0];
    },
  },
  methods: {
    onInfo() {
      this.showModal = true;
    },
    onCloseModal() {
      this.showModal = false;
    },
    onPause() {
      this.isPause = true;
      clearInterval(this.intervalId);
    },
    onCloseModalPause() {
      this.isPause = false;
      if (this.isStart) {
        this.intervalId = setInterval(() => {
          this.totalTime++;
        }, 1000);
      }
    },

    onStart() {
      this.isCheck = false;
      this.isStart = true;

      this.onReady();
      setTimeout(() => {
        if (this.isStart) {
          this.intervalId = setInterval(() => {
            this.totalTime++;
          }, 1000);
        }
      }, 3000);
    },
    onReady() {
      this.isReady = true;
      this.intervalStarTime = setInterval(() => {
        if (this.startTime > 1) {
          this.startTime--;
        } else {
          this.startTime = "Go";
          clearInterval(this.intervalStarTime);
          setTimeout(() => {
            this.isReady = false;
          }, 1000);
        }
      }, 1000);
    },
    onNext() {
      console.log(123);
    },
  },
};
</script>
<style lang="css" scoped>
.container {
  max-width: 580px;
  margin-top: 50px;
}
.content-exercise {
  text-align: center;
}
.exercise-title {
  font-size: 32px;
  font-weight: 700;
  margin-bottom: 20px;
}
.image {
  width: 360px;
  height: 360px;
}
.time {
  font-size: 26px;
}
.time-number {
  display: flex;
  justify-content: center;
  font-size: 38px;
  font-weight: bold;
}
.time-title {
  display: flex;
  justify-content: center;
  font-weight: 600;
  color: #c3c3c3;
}
.sub-title {
  font-size: 20px;
  color: #737373;
  font-weight: 500;
  margin: 20px 0;
  text-align: start;
}
.infor {
  display: flex;
  justify-content: end;
}
.icon-info {
  cursor: pointer;
  margin-right: 20px;
}
.icon-info:hover {
  color: var(--primary);
}
.footer-content {
  margin-top: 20px;
  display: flex;
  justify-content: space-evenly;
  padding: 0 80px;
}
.action {
  padding: 14px 44px;

  border-radius: 8px;
}
.btn-pause {
  border: solid 1px #ccc;
  background-color: #fff;
}
.btn-pause:hover {
  border: solid 1px #000;
}
.btn-next {
  color: #fff;
  padding: 0 20px;
  font-size: 18px;
  font-weight: 700;
  width: 240px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.title-ready {
  font-size: 30px;
  color: #f29f06c4;
}
.sub-title-ready {
  font-size: 50px;
  font-weight: bold;
  color: var(--primary);
}
.start-time {
  font-size: 40px;
  font-weight: 900;
  margin-top: 20px;
  color: var(--primary);
}
.ready {
  font-size: 70px;
}

.icon {
  width: 20px;
  height: 20px;
}
</style>