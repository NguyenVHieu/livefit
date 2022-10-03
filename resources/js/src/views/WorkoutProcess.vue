<template>
  <div>
    <Process :listProcess="listProcess" />
    <div class="container">
      <h1 class="heading">Pound for Pound</h1>
      <div class="title">
        <p class="title-timer">59 min</p>
        <p class="title-excercise">{{ listProcess.length }} exercises</p>
      </div>
      <p class="sub-title">
        A great way to burn through fat while toning muscle is to lift heavy
        things. Today, we're going to do just that! Each exercise is to be
        completed in standard, chronological fashion. Work hard today in order
        to win tomorrow!
      </p>

      <div class="content">
        <div class="content-action">
          <div class="d-block">
            <feather-icon class="icon" icon="ArrowRightIcon" />
            <span class="action-title">Auto-advance</span>
          </div>
          <span :style="{ color: '#c0c0c0' }"
            >Start exercises automatically
            <feather-icon
              v-if="!active"
              class="icon-toggle"
              icon="ToggleLeftIcon"
              @click="onToggle('off')"
            />
            <feather-icon
              v-if="active"
              class="icon-toggle"
              icon="ToggleRightIcon"
              :style="{ color: 'var(--primary)' }"
              @click="onToggle('on')"
            /><br />
            after a 5-second delay</span
          >
          <div class="action">
            <router-link
              to="/workout-process-start"
              :style="{ display: 'block' }"
            >
              <b-button
                class="action-btn"
                variant="gradient-success"
                :style="{ marginTop: '20px' }"
                >Start Workout</b-button
              >
            </router-link>
            <a href="/workout" :style="{ display: 'block' }">
              <button class="action-btn btn-cancel">Cancel Workout</button>
            </a>
          </div>
        </div>
      </div>
      <div v-if="isShow" class="content-auto">
        <h3 :style="{ color: '#fff' }">Auto-advance {{ textToggle }}</h3>
      </div>
    </div>
  </div>
</template>
<script>
import Process from "../layouts/components/Process.vue";
export default {
  components: {
    Process,
  },
  data() {
    return {
      listProcess: [],
      active: true,
      textToggle: "",
      isShow: false,
    };
  },
  created() {
    this.$store.dispatch("header/closeHeader");
    this.listProcess = this.$store.state.workout.listWorkout;
  },
  methods: {
    onToggle(type) {
      if (type == "off") {
        this.active = true;
        this.textToggle = "enabled";
        this.isShow = true;
        setTimeout(() => {
          this.isShow = false;
        }, 3000);
      } else {
        this.active = false;
        this.textToggle = "disabled";
        this.isShow = true;
        setTimeout(() => {
          this.isShow = false;
        }, 3000);
      }
    },
  },
};
</script>
<style lang="css" scoped>
.container {
  position: relative;
  text-align: center;
  max-width: 580px;
  margin-top: 100px;
}

.content-auto {
  background-color: var(--primary);
  color: #fff;
  position: fixed;
  z-index: 12;
  top: 50%;
  left: 39%;
  padding: 10px 20px;
  border-radius: 10px;
  animation: example linear 3s;
}
.heading {
  font-size: 40px;
  font-weight: bold;
}
.title {
  display: flex;
  justify-content: center;
  font-size: 24px;
  font-weight: 700;
  margin: 20px 0;
}
.title-timer {
  color: var(--primary);
  margin-right: 16px;
}
.title-excercise {
  color: #c0c0c0;
}
.sub-title {
  text-align: start;
  font-size: 18px;
  line-height: 1.4;
}
.content-action {
  margin-top: 200px;
  transform: translateX(-50%);
  font-size: 18px;
  text-align: start;
}
.action-title {
  color: #000;
  font-weight: 600;
}
.action-btn {
  width: 100%;
  color: #fff;
  font-size: 18px;
  font-weight: 800;
  margin-bottom: 20px;
  padding: 10px;
}
.btn-cancel {
  background-color: transparent;
  color: #000;
  border-radius: 4px;
  border: solid 1px #ccc;
}
.btn-cancel:hover {
  border: solid 2px #000;
}
.icon {
  width: 20px;
  height: 20px;
}
.icon-toggle {
  cursor: pointer;
  width: 30px;
  height: 30px;
  margin-left: 20px;
}

@keyframes example {
  from {
    opacity: 1;
  }
  to {
    opacity: 0;
  }
}
</style>