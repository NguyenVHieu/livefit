<template>
  <div class="header">
    <div>
      <router-link to="/" :style="{ textDecoration: 'none', color: '#000' }">
        <img class="logo" src="../../assets/images/logo/logo_gym.webp" />
        <span class="heading">Workout</span>
        <span :style="{ fontSize: '23px' }">Labs</span>
      </router-link>
      <!-- <span class="sub-heading">Fit</span> -->
    </div>
    <nav>
      <router-link class="nav-menu" to="/"> Features </router-link>
      <a href="/workout" class="nav-menu">Workouts</a>
      <a href="/workout-builder" class="nav-menu">Workout Builder</a>
      <router-link class="nav-menu" to="/"> iPhone App </router-link>
      <a v-if="showRegister" href="/sign-in" class="nav-menu">Sign In</a>
      <a v-if="showRegister" href="/register">
        <b-button class="btn-start" variant="gradient-success"
          >Start free trial</b-button
        >
      </a>
      <div
        v-if="!showRegister"
        class="avatar"
        @mouseout="onMouseOver"
        @mouseleave="onMouseLeave"
      >
        <img
          class="avatar-img"
          src="https://pixinvent.com/demo/vuexy-vuejs-admin-dashboard-template/demo-1/img/avatar-s-2.da5e73c7.jpg"
        />
        <div class="information">
          <p>Melisa</p>
          <p>User</p>
        </div>
        <div v-if="showTool" class="show-infor">
          <ul class="list-infor">
            <li
              class="infor-item"
              v-for="(item, index) in listInfor"
              :key="index"
            >
              <a class="infor-item-link" :href="item.link ? item.link : '#'">
                <feather-icon class="infor-item-icon" :icon="item.icon" />
                <p class="infor-item-title">{{ item.title }}</p>
              </a>
            </li>
          </ul>
          <ul class="list-tool">
            <li
              class="tool"
              v-for="(item, index) in listTools"
              :key="index"
              @click="onClickTool(item.type)"
            >
              <feather-icon class="infor-item-icon" :icon="item.icon" />
              <p class="infor-item-title">{{ item.title }}</p>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</template>
<script>
export default {
  name: "HeaderView",
  data() {
    return {
      showRegister: true,
      showTool: false,
      listInfor: [
        {
          icon: "UserIcon",
          title: "Profile",
          link: "/profile",
        },
        {
          icon: "MailIcon",
          title: "Inbox",
        },
        {
          icon: "CheckSquareIcon",
          title: "Task",
        },
        {
          icon: "MessageSquareIcon",
          title: "Chat",
        },
      ],
      listTools: [
        {
          icon: "SettingsIcon",
          title: "Settings",
        },
        {
          icon: "HelpCircleIcon",
          title: "FAQ",
        },
        {
          icon: "LogOutIcon",
          title: "Log out",
          type: "logout",
        },
      ],
    };
  },
  created() {
    if (localStorage.getItem("login")) {
      this.showRegister = false;
    }
  },

  methods: {
    onMouseOver() {
      this.showTool = true;
    },
    onMouseLeave() {
      this.showTool = false;
    },
    onClickTool(type) {
      if (type == "logout") {
        localStorage.removeItem("login");
        this.showRegister = true;
        window.location.href = "/workout";
      }
    },
  },
};
</script>
<style lang="css" scoped>
.header {
  position: fixed;
  top: 0;
  right: 0;
  left: 0;
  z-index: 12;
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  height: 80px;
  box-shadow: 0px 1px 2px 0px rgb(61 61 77 / 10%);
  background-color: rgba(255, 255, 255, 0.97);
  padding: 0 50px;
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
}

.nav-menu {
  text-decoration: none;
  color: #000;
  font-size: 18px;
  margin: 0 20px;
}
.nav-menu:hover {
  color: var(--primary);
}
.btn-start {
  padding: 10px 20px;
  font-weight: bold;
  margin: 0 20px;
  border: none;
  border-radius: 6px;
  color: #fff;
  background-color: var(--primary);
}
.avatar {
  position: relative;
  background-color: #fff;
  color: #000;
}
.avatar-img {
  width: 50px;
  height: 50px;
}
.show-infor {
  position: absolute;
  bottom: -332px;
  left: -10px;
  border-radius: 8px;
  width: 145px;
  background-color: #fff;
  color: #000;
  box-shadow: 0px 0px 10px #888888;
}
.show-infor::after {
  position: absolute;
  content: "";
  width: 100%;
  height: 28px;
  background-color: transparent;
  top: -28px;
  left: 0;
}
.list-infor {
  list-style-type: none;
  border-bottom: solid 1px #ccc;
}
.list-tool {
  list-style-type: none;
}
.tool,
.infor-item {
  display: flex;
  align-items: center;
  padding: 10px;
}
.infor-item-link {
  display: contents;
  color: #000;
  text-decoration: none;
}
.infor-item-link:hover {
  color: #fff;
}
.infor-item:first-child {
  border-top-left-radius: 8px;
  border-top-right-radius: 8px;
}
.tool:hover,
.infor-item:hover {
  background-color: #5f8df5b5;
  color: #fff;
}
.infor-item-title {
  margin: 0;
  font-size: 16px;
}
.infor-item-icon {
  margin: 0 30px 0 10px;
}
.information {
  margin: 10px 0 0 10px;
}
.information > p {
  margin: 0;
}
</style>
