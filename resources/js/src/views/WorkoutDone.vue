<template>
  <div class="container">
    <div class="content-modal">
      <h1 class="heading">Workout done!</h1>
      <img
        class="image"
        src="https://workoutlabs.com/workout-done-gifs/gif.php?p=fit&uid=0"
      />
      <div class="footer">
        <div class="footer-content">
          <span>Exercises done</span>
          <span :style="{ color: 'var(--primary)' }">1 of 8</span>
        </div>
        <div class="footer-content">
          <span>Total time</span>
          <span
            >{{ minutes >= 10 ? minutes : "0" + minutes }}:{{
              seconds >= 10 ? seconds : "0" + seconds
            }}</span
          >
        </div>
      </div>
      <a href="/workout" :style="{ display: 'block', textDecoration: 'none' }">
        <b-button class="action btn-back-home" variant="gradient-success">
          <span>Browse more workouts</span>
          <feather-icon class="icon-back" icon="ArrowRightIcon" />
        </b-button>
      </a>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      totalTime: 0,
      minutes: 0,
      seconds: 0,
    };
  },
  created() {
    this.$store.dispatch("header/closeHeader");
    console.log(this.$store.state.users.timer);
    this.totalTime = this.$store.state.users.timer;
  },
  computed: {
    countMinutes() {
      return Math.floor(this.totalTime / 60);
    },
    countSeconds() {
      return this.totalTime % 60;
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
};
</script>
<style lang="css" scoped>
.content-modal {
  width: 480px;
  margin-top: 100px;
  text-align: center;
  margin-left: 50%;
  transform: translateX(-50%);
}
.heading {
  font-weight: bold;
  margin-bottom: 20px;
  color: var(--primary);
}
.image {
  background-size: cover;
  width: 100%;
  height: 270px;
}
.footer {
  display: flex;
  position: relative;
  justify-content: space-evenly;
  margin-top: 40px;
  font-size: 20px;
  font-weight: 600;
}
.footer::before {
  position: absolute;
  content: "";
  background-color: #ccc;
  width: 1px;
  height: 100%;
  left: 50%;
}
.footer-content {
  display: flex;
  flex-direction: column;
}
.btn-back-home {
  margin-top: 20px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  color: #fff;
  padding: 10px;
  width: 300px;
  font-size: 18px;
  font-weight: bold;
  margin-left: 96px;
}
.icon-back {
  width: 20px;
  height: 20px;
}
</style>