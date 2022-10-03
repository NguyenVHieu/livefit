<template>
  <div class="container-modal">
    <div class="content-modal">
      <div class="header">
        <feather-icon
          class="icon-close"
          icon="ArrowRightIcon"
          @click="onCloseModal"
        />
        <h5>{{ title }}</h5>
      </div>
      <img src="../../assets/images/exercise/hinh1.png" />
      <div>
        <ul class="list-items">
          <li
            v-for="(item, index) in listRender"
            :key="index"
            class="item"
            @mouseover="onMouseOver(index)"
            @mouseleave="onMouseLeave(index)"
          >
            <span :class="{ active: item.isOver }">
              {{ item.name }}
            </span>

            <feather-icon
              v-if="item.check == true"
              class="icon-toggle"
              icon="ToggleRightIcon"
              :style="{ color: 'var(--primary)' }"
              @click="onClickToggle('right', index)"
            />
            <feather-icon
              v-if="item.check == false"
              class="icon-toggle"
              icon="ToggleLeftIcon"
              @click="onClickToggle('left', index)"
            />
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    type: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      title: "",
      listRender: null,
      listExercise: [
        {
          name: "Cardio",
          check: true,
          isOver: false,
        },
        {
          name: "Stretch",
          check: true,
          isOver: false,
        },
        {
          name: "Warm Up",
          check: true,
          isOver: false,
        },
        {
          name: "Physycal Therapy/Rehab",
          check: true,
          isOver: false,
        },
        {
          name: "CoolDown",
          check: true,
          isOver: false,
        },
        {
          name: "Work Out",
          check: true,
          isOver: false,
        },
        {
          name: "Yoga",
          check: false,
          isOver: false,
        },
      ],
      listMuscles: [
        {
          name: "All",
          check: true,
          isOver: false,
        },
        {
          name: "Abs",
          check: false,
          isOver: false,
        },
        {
          name: "Ankles",
          check: false,
          isOver: false,
        },
        {
          name: "Biceps",
          check: false,
          isOver: false,
        },
        {
          name: "Calves",
          check: false,
          isOver: false,
        },
        {
          name: "Chest",
          check: false,
          isOver: false,
        },
        {
          name: "Forearms",
          check: false,
          isOver: false,
        },
      ],
      listFullgym: [
        {
          name: "Full gym",
          check: true,
          isOver: false,
        },
        {
          name: "Agility Ladder",
          check: false,
          isOver: false,
        },
        {
          name: "Barbell/ EZ-Bar",
          check: false,
          isOver: false,
        },
        {
          name: "Battle Rope",
          check: false,
          isOver: false,
        },
      ],
    };
  },
  created() {
    if (this.type === "exercise") {
      this.title = "EXERCISE TYPE";
      this.listRender = this.listExercise;
    } else if (this.type === "muscle") {
      this.listRender = this.listMuscles;
      this.title = "MUSCLE GROUPS";
    } else {
      this.title = "EQUIPMENT";
      this.listRender = this.listFullgym;
    }
  },
  methods: {
    onCloseModal() {
      this.$emit("closeModal");
    },
    onClickToggle(type, index) {
      if (type === "left") {
        this.listRender[index].check = true;
      } else {
        this.listRender[index].check = false;
      }
    },
    onMouseOver(index) {
      this.listRender[index].isOver = true;
    },
    onMouseLeave(index) {
      this.listRender[index].isOver = false;
    },
  },
};
</script>
<style lang="css" scoped>
.container-modal {
  position: absolute;
  z-index: 1;
  right: 0;
  top: 0;
  margin-top: 50px;
  height: 100%;
  width: 100%;
  background-color: #fff;
  animation: example linear 0.2s;
  box-shadow: 0px 0px 4px 2px #ccc;
}
.header {
  display: flex;
  justify-content: center;
  padding-top: 10px;
}
img {
  margin: 32px 0;
  width: 280px;
  height: 280px;
  margin-left: 50%;
  transform: translateX(-50%);
}
.list-items {
  list-style-type: none;
  max-height: 200px;
  overflow-y: auto;
}
.item {
  cursor: pointer;
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 18px;
  padding: 10px 30px 10px 20px;
  border-top: solid 1px #ccc;
}
.icon-close {
  cursor: pointer;
  position: relative;
  left: -105px;
  width: 20px;
  height: 20px;
}
.icon-toggle {
  width: 30px;
  height: 30px;
}
.active {
  color: var(--primary);
}
@keyframes example {
  from {
    right: -50px;
  }
  to {
    right: 0;
  }
}
</style>
