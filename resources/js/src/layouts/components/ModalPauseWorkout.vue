<template>
  <div class="container-modal">
    <div class="content-modal">
      <feather-icon class="icon" icon="XIcon" @click="onClose" />
      <div class="content-heading">
        <h3 class="heading">We're not done yet!</h3>
      </div>
      <div class="content-exercise">
        <div class="exercise-done">
          <span>Exercise done</span>
          <span class="sub-dec" :style="{ color: '#c2c2c2' }">0 of 9</span>
        </div>
        <div class="time-done">
          <span>Approx. time left</span>
          <span class="sub-dec"
            >{{ minutes >= 10 ? minutes : "0" + minutes }}:{{
              seconds >= 10 ? seconds : "0" + seconds
            }}</span
          >
        </div>
      </div>
      <b-button class="action" variant="gradient-success" @click="onClose"
        >Get back to it!</b-button
      >
      <router-link to="/workout-done" :style="{ display: 'block' }">
        <button class="action btn-stop" @click="onStop">
          I'm done. Stop here.
        </button>
      </router-link>
      <a href="/workout" :style="{ display: 'block', textDecoration: 'none' }">
        <button class="action btn-back-home">
          <span>Browse more workouts</span>
          <feather-icon class="icon-back" icon="ArrowRightIcon" />
        </button>
      </a>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    totalTime: {
      type: Number,
      required: false,
    },
  },
  data() {
    return {
      timer: 3600,
      minutes: 0,
      seconds: 0,
    };
  },
  created() {
    this.timer = this.timer - this.totalTime;
  },
  computed: {
    countMinutes() {
      this.minutes = Math.floor(this.timer / 60);
      return Math.floor(this.timer / 60);
    },
    countSeconds() {
      this.seconds = this.timer % 60;
      return this.timer % 60;
    },
  },
  watch: {
    countMinutes(newVal) {
      this.minutes = newVal;
    },
    countSeconds(newVal) {
      this.seconds = newVal;
    },
  },
  methods: {
    onClose() {
      this.$emit("closeModal");
    },
    onStop() {
      this.$store.dispatch("users/addTimer", { payload: this.totalTime });
    },
  },
};
</script>
<style lang="css" scoped>
.container-modal {
  position: fixed;
  z-index: 12;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
}
.content-modal {
  position: absolute;
  background-color: #fff;
  width: 370px;
  text-align: center;
  /* bottom: 200px; */
  top: 100px;
  left: 50%;
  transform: translateX(-50%);
  border-radius: 16px;
  padding: 40px;
  /* animation: example linear 0.5s; */
}
.icon {
  position: absolute;
  right: 10px;
  top: 10px;
  cursor: pointer;
  width: 20px;
  height: 20px;
  opacity: 0.5;
}
.icon:hover {
  opacity: 1;
}
.content-heading {
  padding: 10px 0;
  border-bottom: solid 1px #ccc;
  margin-bottom: 20px;
}
.heading {
  color: #000;
  font-weight: bold;
}
.content-exercise {
  position: relative;
  display: flex;
  justify-content: space-between;
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 40px;
}
.content-exercise::before {
  position: absolute;
  content: "";
  width: 1px;
  height: 100%;
  top: 0;
  bottom: 0;
  left: 50%;
  background-color: #ccc;
}
.time-done,
.exercise-done {
  display: flex;
  flex-direction: column;
}
.sub-dec {
  font-size: 25px;
  font-weight: bold;
}
.action {
  width: 100%;
  color: #fff;
  font-size: 18px;
  font-weight: 700;
  padding: 10px;
  margin-bottom: 20px;
}
.btn-back-home,
.btn-stop {
  background-color: transparent;
  color: #000;
  border: solid 1px #ccc;
  border-radius: 4px;
  margin-bottom: 20px;
}
.btn-stop:hover {
  border-color: #000;
}
.btn-back-home {
  margin-top: 20px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  color: #fff;
  background-color: var(--blue) !important;
}
.icon-back {
  width: 20px;
  height: 20px;
}
@keyframes example {
  from {
    bottom: -10px;
  }
  to {
    bottom: 200px;
  }
}
</style>