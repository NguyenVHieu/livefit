<template>
  <div class="modal-infor">
    <div class="content-infor">
      <feather-icon class="icon-close" icon="XIcon" @click="onCloseModal" />
      <div class="row" :style="{ marginBottom: '32px' }">
        <div class="col-3">
          <img
            src="https://workoutlabs.com/fit/wp-content/themes/printableworkouts/img/muscle-groups/master.png"
          />
        </div>
        <div class="col-9">
          <h3>Barbell Deadlifts</h3>
          <div class="row">
            <div class="col-6">
              <p class="title">Primary muscle group(s):</p>
              <p class="sub-title">Lower Back</p>
            </div>
            <div class="col-6">
              <p class="title">Secondary:</p>
              <p class="sub-title">
                Abs, Calves, Forearms, Glutes & Hip Flexors, Hamstrings,
                Quadriceps, Upper Back & Lower Traps
              </p>
            </div>
          </div>
          <div>
            <p>
              Place a barbell in a clear space on the floor. (Make sure there
              are no obstructions in your way. Stand facing the barbell with
              your legs about 4-6 inches from the bar. Place your feet shoulder
              width apart.Your feet can be pointed straight ahead or turned
              outwards slightly. Squat down, keeping your back straight and grip
              the bar with an overhand grip at shoulder width. Keep your arms
              fully extended and stand up with the barbell. As you lift the
              barbell, your hips and shoulders should rise together and your
              back should be straight. As you reach the top of the lift and are
              standing straight, rotate your shoulders back slightly until you
              feel a slight stretch in them. Lower the barbell back to the floor
              in the same squatting motion you used to lift it.
            </p>
          </div>
          <div class="d-flex">
            <feather-icon icon="AlertOctagonIcon" class="icon-infor" />
            <p :style="{ fontSize: '14px', color: '#c2c2cc' }">
              This exercise can be very dangerous if performed incorrectly. If
              you are a novice, only perform this exercise with an experienced
              trainer's supervision.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  methods: {
    onCloseModal() {
      this.$emit("closeModal");
    },
  },
};
</script>
<style lang="css" scoped>
.modal-infor {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 20;
  background-color: rgba(0, 0, 0, 0.5);
}
.content-infor {
  background-color: #fff;
  position: absolute;
  width: 966px;
  /* height: 400px; */
  left: 50%;
  transform: translateX(-50%);
  top: 100px;
  border-radius: 16px;
  padding: 20px;
  font-size: 16px;
  animation: identifier linear 0.6s;
}
.icon-close {
  cursor: pointer;
  right: 20px;
  width: 20px;
  height: 20px;
}
img {
  height: 270px;
  margin-top: 60px;
}
.title {
  color: #c2c2cc;
  font-size: 18px;
  letter-spacing: -0.3px;
  line-height: 18px;
  margin-bottom: 4px;
}
.sub-title {
  color: #000;
  font-weight: 500;
  line-height: 18px;
}
.icon-infor {
  height: 20px;
  width: 20px;
  margin-top: 10px;
  margin-right: 10px;
  color: #fd953b;
}
@keyframes identifier {
  from {
    opacity: 0.5;
  }
  to {
    opacity: 1;
  }
}
</style>