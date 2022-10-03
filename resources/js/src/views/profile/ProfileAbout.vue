<template>
  <b-card>
    <!-- about -->
    <div class="menu">
      <ul class="list-menu">
        <li
          v-for="(menu, index) in listMenu"
          :key="index"
          class="menu-item"
          @click="onClickMenu(menu.type)"
        >
          {{ menu.nav }}
        </li>
      </ul>
    </div>
  </b-card>
</template>

<script>
import { BCard, BCardText } from "bootstrap-vue";

export default {
  components: {
    BCard,
    BCardText,
  },
  props: {
    aboutData: {
      type: Object,
      default: () => {},
    },
  },
  data() {
    return {
      listMenu: [
        {
          nav: "Overview",
          type: "view",
        },
        {
          nav: "My Plan",
          type: "plan",
        },
        {
          nav: "My Meal",
          type: "meal",
        },
        {
          nav: "My Workout",
          type: "workout",
        },
        {
          nav: "My Calendar",
          type: "calendar",
        },
      ],
    };
  },
  methods: {
    onClickMenu(type) {
      this.$emit("clickMenu", type);
    },
  },
};
</script>
<style lang="css" scoped>
.list-menu {
  list-style-type: none;
  text-align: start;
}
.menu-item {
  cursor: pointer;
  padding: 10px 0;
  border-bottom: solid 1px #ccc;
  font-size: 16px;
  font-weight: 500;
}
.menu-item:hover {
  background-color: rgb(247, 247, 247);
}
</style>
