<template>
  <div class="container-workout">
    <div class="header">
      <div>
        <router-link to="/" :style="{ textDecoration: 'none', color: '#000' }">
          <img class="logo" src="../assets/images/logo/logo_gym.webp" />
          <span class="heading">Workout</span>
          <span :style="{ fontSize: '23px', color: '#fff' }">Labs</span>
        </router-link>
      </div>
      <div class="group-gender">
        <a
          class="gender"
          :class="{ active: typeGender == 'male' }"
          @click="onClickGender('male')"
          >Male</a
        >
        <a
          class="gender"
          :class="{ active: typeGender == 'female' }"
          @click="onClickGender('female')"
          >Female</a
        >
      </div>
      <a href="/workout">
        <button class="btn-more">
          More Workouts
          <feather-icon class="icon" icon="ArrowRightIcon" />
        </button>
      </a>
    </div>
    <div class="container" :style="{ marginTop: '200px' }">
      <div class="navigation">
        <div class="content-nav">
          <feather-icon class="nav-icon" icon="AlignRightIcon" />
        </div>
        <div class="content-nav" :style="{ margin: '0 40px' }">
          <feather-icon class="nav-icon" icon="DownloadIcon" />
        </div>
        <div class="content-nav">
          <feather-icon class="nav-icon" icon="MoreHorizontalIcon" />
        </div>
      </div>
      <div class="content-workout">
        <div class="title">
          <h3 :style="{ fontWeight: 'bold', color: '#000' }">
            Back & Biceps (Sample gym workout)
          </h3>
          <div class="description">
            <div class="d-flex" :style="{ fontSize: '18px' }">
              <p :style="{ color: 'var(--primary)', marginRight: '20px' }">
                53 min
              </p>
              <p>{{ lisData.length }} exercises</p>
            </div>
            <p>
              The Double B! Back and Biceps! Don't forget to note the amounts of
              weight used, especially for the progressive overloading exercises.
              Stay hydrated, limber, and mean! Let's go!
            </p>
          </div>
        </div>
        <div v-for="(item, idx) in lisData" :key="idx" class="content-exercise">
          <div class="content-repeat">
            <feather-icon
              @click="onRepeat(idx)"
              class="repeat-icon"
              icon="RepeatIcon"
            />
          </div>
          <div class="wrapper-exercise">
            <img class="image" :src="item.image" @click="onClickShawModal" />
            <div>
              <h3 class="sub-title1" @click="onClickShawModal">
                {{ item.describe }}
              </h3>
              <div class="timer" @click="onClickShawModal">
                <div>
                  <span class="title-timer">{{ item.time.sets }}</span>
                  <span class="sub-timer">sets</span>
                </div>
                <div v-if="item.time.reps">
                  <span class="title-timer">{{ item.time.reps }}</span>
                  <span class="sub-timer">reps</span>
                </div>
                <div>
                  <span class="title-timer">{{ item.time.sec }}</span>
                  <span class="sub-timer">sec rest</span>
                </div>
              </div>
            </div>
          </div>
          <p class="sub-title2" @click="onClickShawModal">
            To failure. If too difficult, exchange for reverse rows using a bar.
            Can you beat last week?
          </p>
        </div>
        <div class="dsvsvc" :style="{ height: '120px' }"></div>
      </div>
    </div>
    <div class="footer">
      <div class="wrapper-footer">
        <router-link to="workout-process" :style="{ textDecoration: 'none' }">
          <div class="content-footer footer1" @click="onBegin">
            <span>Begin Workout</span>
            <feather-icon class="icon" icon="ArrowRightIcon" />
          </div>
        </router-link>
        <div class="content-footer footer2">
          <span>Add to my calendar</span>
        </div>
      </div>
    </div>
    <ModalSample
      v-if="showModal"
      @closeModal="onCloseModal"
      :data="dataSample"
      @ClickSample="onClickSample"
    />
    <Modal v-if="isShow" @closeModal="onCloseModal2" />
  </div>
</template>
<script>
import ModalSample from "../layouts/components/ModalWorkoutSample.vue";
import Modal from "../layouts/components/Modal.vue";
export default {
  components: {
    ModalSample,
    Modal,
  },
  data() {
    return {
      lisData: null,
      listDataFilter: null,
      typeGender: "male",
      showModal: false,
      isShow: false,
      indexData: null,
      dataSample: [],
    };
  },
  created() {
    this.$store.dispatch("header/closeHeader");
    this.lisData = this.$store.state.plans.listPlans.planMale;
  },

  methods: {
    onClickGender(type) {
      this.typeGender = type;
      if (type == "male") {
        this.lisData = this.$store.state.plans.listPlans.planMale;
      } else {
        this.lisData = this.$store.state.plans.listPlans.plansFemales;
      }
    },
    onRepeat(idx) {
      this.showModal = true;
      this.indexData = idx;

      if (this.typeGender == "male") {
        this.listDataFilter = this.$store.state.plans.listPlanSearch.filter(
          (ele) => ele.type == "male"
        );
      } else {
        this.listDataFilter = this.$store.state.plans.listPlanSearch.filter(
          (ele) => ele.type == "female"
        );
      }
      console.log(this.listDataFilter);
      if (idx == 1 || idx == 0) {
        this.dataSample = this.listDataFilter.slice(0, 2);
      } else if (idx == 2 || idx == 3) {
        this.dataSample = this.listDataFilter.slice(2, 4);
      } else {
        this.dataSample = this.listDataFilter.slice(4, 6);
      }
    },
    onBegin() {
      this.$store.dispatch("workout/addListWorkout", { payload: this.lisData });
    },
    onCloseModal() {
      this.showModal = false;
    },
    onClickSample(item) {
      this.lisData[this.indexData].image = item.image;
      this.lisData[this.indexData].describe = item.title;
    },
    onClickShawModal() {
      this.isShow = true;
    },
    onCloseModal2() {
      this.isShow = false;
    },
  },
};
</script>
<style lang="css" scoped>
.header {
  height: 80px;
  background-color: var(--primary);
  position: fixed;
  z-index: 12;
  top: 0;
  left: 0;
  right: 0;
  display: flex;
  align-items: center;
  padding: 0 50px;
  justify-content: space-between;
}
.logo {
  width: 60px;
  height: 60px;
  border-radius: 8px;
}
.heading {
  font-weight: 600;
  font-size: 24px;
  margin-left: 16px;
  color: #fff;
}
.group-gender {
  font-size: 20px;
  color: #fff;
  font-weight: 700;
}
.gender {
  opacity: 0.5;
  margin: 0 10px;
}
.gender:hover {
  text-decoration: underline;
}
.btn-more {
  border: solid 2px #fff !important;
  padding: 6px 20px;
  color: #fff;
  font-size: 16px;
  font-weight: 700;
  background-color: transparent;
  border-radius: 6px;
}
.btn-more:hover {
  opacity: 0.8;
}
.icon {
  width: 20px;
  height: 20px;
  margin-left: 10px;
}
.description {
  font-size: 16px;
  margin: 10px 0 30px 0;
}
.navigation {
  cursor: pointer;
  display: flex;
  position: fixed;
  right: 44px;
  z-index: 12;
  top: 100px;
}
.content-nav {
  background-color: #fff;
  padding: 10px;
  border-radius: 50%;
}
.nav-icon {
  width: 30px;
  height: 30px;
}
.content-workout {
  width: 500px;
  margin-left: 50%;
  transform: translateX(-50%);
}
.content-exercise {
  width: 100%;
  background-color: #fff;
  padding: 10px 30px;
  border-radius: 10px;
  margin-bottom: 50px;
  cursor: pointer;
  position: relative;
}
.content-repeat {
  position: absolute;
  right: 0;
  top: 0;
  padding: 4px;
  border: solid 1px #000;
  border-radius: 50%;
}
.repeat-icon {
  width: 20px;
  height: 20px;
}
.wrapper-exercise {
  display: flex;
  align-items: center;
}
.image {
  width: 150px;
  height: 150px;
  margin-right: 20px;
}
.timer {
  display: flex;
  justify-content: space-between;
  /* width: 200px; */
}
.title-timer {
  font-size: 24px;
  color: #000;
  font-weight: bold;
}
.sub-timer {
  font-size: 18px;
  font-weight: 600;
  color: #ccc;
  margin-right: 6px;
}
.sub-title1 {
  color: #000;
}
.sub-title2 {
  margin-top: 20px;
  font-size: 16px;
  font-weight: 600;
}
.footer {
  position: fixed;
  bottom: 0;
  right: 0;
  left: 0;
}
.wrapper-footer {
  position: absolute;
  bottom: 0;
  left: 48%;
}
.content-footer {
  width: 353px;
  padding: 14px 30px;
  color: #fff;
  font-size: 16px;
  border-radius: 6px;
  font-weight: 700;
  margin-bottom: 20px;
  cursor: pointer;
}
.footer1 {
  background-color: var(--primary);
  display: flex;
  justify-content: space-between;
}
.footer2 {
  background-color: var(--blue);
}
.active {
  opacity: 1;
}
</style>