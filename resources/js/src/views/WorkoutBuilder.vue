<template>
  <div class="container-builder">
    <header class="header-builder">
      <a href="/workout" :style="{ color: '#fff' }">
        <feather-icon icon="ArrowLeftIcon" class="icon" />
        <span>NICE! GO BACK</span>
      </a>
      <div class="group-gender">
        <a
          class="gender"
          :class="{ active: isActiveMale }"
          @click="onActive('male')"
          >Male</a
        >
        <a
          class="gender"
          :class="{ active: isActiveFemale }"
          @click="onActive('female')"
          >Female</a
        >
      </div>
      <div class="conection">
        <div class="d-flex conection-item">
          <h4 class="conection-title">Share:</h4>
          <feather-icon icon="TwitchIcon" class="icon-conection" />
          <feather-icon icon="FacebookIcon" class="icon-conection" />
          <feather-icon icon="TwitterIcon" class="icon-conection" />
          <feather-icon icon="DownloadIcon" class="icon-conection" />
        </div>
        <div class="d-flex conection-item">
          <h4 class="conection-title">Demo mode</h4>
          <feather-icon icon="BellIcon" class="icon-conection" />
          <feather-icon icon="DiscIcon" class="icon-conection" />
        </div>
      </div>
    </header>
    <div class="content row" :style="{ marginTop: '80px' }">
      <div class="col-9" :style="{ maxHeight: '700px', overflowY: 'auto' }">
        <div class="container-heading">
          <div class="content-heading">
            <h3>Back & Biceps (Sample gym workout)</h3>
            <p>35 min · Arms, Back, Shoulders</p>
          </div>
          <div :style="{ maxWidth: '600px' }">
            <p :style="{ margin: '20px 0 50px 0' }">
              The Double B! Back and Biceps! Don't forget to note the amounts of
              weight used, especially for the progressive overloading exercises.
              Stay hydrated, limber, and mean! Let's go!
            </p>
          </div>
        </div>
        <div
          class="row inner"
          :style="{ padding: '0 100px' }"
          @drop="onDrogPlanSearch($event)"
          @dragover.prevent
          @dragenter.prevent
        >
          <Plan
            v-for="(item, index) in listPlan"
            draggable="true"
            :key="index"
            :item="item"
            :index="index"
            @removePlan="onRemove(index)"
            @showInfor="onShawInforPlan"
            @detail="onShawModalDetailPlan($event)"
            @dragDrop="onDragDrop"
          />
        </div>
      </div>
      <div class="col-3 search-plan">
        <b-input-group
          size="sm"
          class="mb-2"
          :style="{ position: 'fixed', zIndex: '12' }"
        >
          <b-input-group-prepend is-text>
            <b-icon icon="search"></b-icon>
          </b-input-group-prepend>
          <b-form-input
            class="input-search"
            type="search"
            placeholder="Search terms"
          ></b-form-input>
        </b-input-group>
        <div class="content-search">
          <div class="group-search1" :style="{ paddingTop: '10px' }">
            <span class="title-search">EXERCISE TYPE</span>
            <p
              class="sub-title-search"
              @click="onShowModalExercise('exercise')"
            >
              Cardio, Stretch, Warm Up
            </p>
          </div>
          <div class="d-flex group-search2">
            <div :style="{ paddingLeft: '20px' }">
              <span class="title-search">MUSCLE GROUPS</span>
              <p
                class="sub-title-search"
                @click="onShowModalExercise('muscle')"
              >
                ALL
              </p>
            </div>
            <div :style="{ marginLeft: '60px', paddingLeft: '20px' }">
              <span class="title-search">EQUIPMENT</span>
              <p
                class="sub-title-search"
                @click="onShowModalExercise('fullgym')"
              >
                FULL GYM
              </p>
            </div>
          </div>
          <div class="d-flex group-search3">
            <div class="group-search3-title">
              <span>581</span>
              <span :style="{ marginLeft: '10px' }">Hide images</span>
            </div>
            <div class="group-search3-title">
              <feather-icon icon="StarIcon" />
              <span :style="{ marginLeft: '10px' }">Suggest an exercise</span>
            </div>
          </div>
        </div>
        <ModalExercise
          v-if="isShowModalExercise"
          @closeModal="onCloseModalExercise"
          :type="type"
        />

        <div class="container-plan_search">
          <PlanSearch
            v-for="(plan, index) in listPlanSearch"
            :key="index"
            :item="plan"
            :index="index"
            @drag="dragPlanSearch"
            @showInfor="onShawInforPlan"
            @addPlan="onAddPlan($event)"
          />
        </div>
      </div>
    </div>
    <Modal v-if="isShawInfor" @closeModal="onCloseInforPlan" />
    <ModalSetupTime
      v-if="isShowModalDetail"
      :item="planDetail"
      @closeModal="onCloseModalDetail"
    />
  </div>
</template>
<script>
import Plan from "../layouts/components/Plan.vue";
import PlanSearch from "../layouts/components/PlanSearch.vue";
import Modal from "../layouts/components/Modal.vue";
import ModalSetupTime from "../layouts/components/ModalSetupTime.vue";
import ModalExercise from "../layouts/components/ModalExercise.vue";
export default {
  components: {
    Plan,
    Modal,
    ModalSetupTime,
    ModalExercise,
    PlanSearch,
  },
  data() {
    return {
      listPlan: [],
      listPlanSearch: [],
      type: null,
      planDetail: {},
      isShawInfor: false,
      isActiveMale: true,
      isActiveFemale: false,
      isShowModalDetail: false,
      isShowModalExercise: false,
    };
  },
  created() {
    this.$store.dispatch("header/closeHeader");
    this.listPlan = this.$store.state.plans.listPlans.planMale;
    this.listPlanSearch = this.$store.state.plans.listPlanSearch.filter(
      (plan) => plan.type == "male"
    );
  },
  methods: {
    onRemove(index) {
      this.listPlan.splice(index, 1);
    },
    onShawInforPlan() {
      this.isShawInfor = true;
    },
    onCloseInforPlan() {
      this.isShawInfor = false;
    },
    onActive(type) {
      if (type == "male") {
        this.isActiveMale = true;
        this.isActiveFemale = false;
        this.listPlan = this.$store.state.plans.listPlans.planMale;
        this.listPlanSearch = this.$store.state.plans.listPlanSearch.filter(
          (plan) => plan.type == "male"
        );
      } else {
        this.isActiveMale = false;
        this.isActiveFemale = true;
        this.listPlan = this.$store.state.plans.listPlans.plansFemales;
        this.listPlanSearch = this.$store.state.plans.listPlanSearch.filter(
          (plan) => plan.type == "female"
        );
      }
    },
    onAddPlan(item) {
      this.$store.dispatch("plans/addNewPlan", { payload: item });
    },
    onShawModalDetailPlan(plan) {
      this.isShowModalDetail = true;
      this.planDetail = plan;
    },
    onCloseModalDetail() {
      this.isShowModalDetail = false;
    },
    onShowModalExercise(type) {
      this.isShowModalExercise = true;
      this.type = type;
    },
    onCloseModalExercise() {
      this.isShowModalExercise = false;
    },
    onDragDrop(itemID, index) {
      let item1 = this.listPlan[itemID];

      this.$set(this.listPlan, itemID, this.listPlan[index]);
      this.$set(this.listPlan, index, item1);
    },
    dragPlanSearch(index) {
      console.log("drag", index);
    },
    onDrogPlanSearch(event) {
      const itemID = event.dataTransfer.getData("planSearch");
      this.listPlan.push(this.listPlanSearch[itemID]);
      console.log("drop", itemID);
    },
  },
};
</script>
<style lang="css" scoped>
.header-builder {
  position: fixed;
  top: 0;
  right: 0;
  left: 0;
  z-index: 12;
  display: flex;
  align-items: center;
  justify-content: space-between;
  background-color: var(--primary);
  height: 80px;
  color: #fff;
  padding: 0 10px;
  font-size: 18px;
  font-weight: 700;
}
.group-gender {
  position: relative;
  left: 90px;
}
.gender {
  padding: 10px 20px;

  opacity: 0.5;
}
.gender:hover {
  opacity: 1;
  text-decoration: underline;
}
.icon {
  width: 20px;
  height: 20px;
}
.icon-conection {
  width: 26px;
  height: 26px;
}
.conection {
  width: 600px;
  display: flex;
  justify-content: space-around;
}
.conection-item {
  width: 270px;
  justify-content: space-around;
}
.conection-title {
  color: #fff;
  opacity: 0.8;
  margin: 0 20px;
}
.content {
  margin-left: 0;
}
.content-heading {
  border-bottom: solid 1px #ccc;
}
.container-heading {
  display: flex;
  flex-direction: column;
  padding: 0 150px;
  margin-top: 50px;
}
.active {
  opacity: 1;
  text-decoration: underline;
}
.search-plan {
  padding: 0;
  background-color: #6a7082;
}
.content-search {
  margin-top: 50px;
}
.input-search {
  padding: 24px 10px;
  font-size: 16px;
}
.title-search {
  font-size: 18px;
  color: #ccc;
}
.group-search1 {
  padding: 20px 0;
  padding-left: 20px;
  border-bottom: 1px solid #ccc;
}
.group-search2 {
  padding-top: 10px;
  position: relative;
}
.group-search3 {
  justify-content: space-between;
  font-size: 16px;
  color: #c2c2cc;
  padding: 10px;
  padding-right: 20px;
  background-color: #323131;
}
.group-search3-title:hover {
  cursor: pointer;
}
.group-search2::before {
  position: absolute;
  content: "";
  width: 1px;
  background-color: #ccc;
  height: 100%;
  top: 0;
  left: 50%;
}
.sub-title-search {
  margin-top: 20px;
  color: #fff;
  font-weight: 700;
  font-size: 16px;
}
.sub-title-search:hover {
  cursor: pointer;
  text-decoration: underline;
}
.container-plan_search {
  background-color: #fff;
  max-height: 500px;
  overflow-y: auto;
}
</style>