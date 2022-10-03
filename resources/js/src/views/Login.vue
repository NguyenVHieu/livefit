<template>
  <div :style="{ marginTop: '120px' }" class="container">
    <div class="content">
      <div class="container-heading">
        <h3 class="heading">Welcome back!</h3>
      </div>
      <div class="conection" :style="{ marginTop: '20px' }">
        <div class="facebook">
          <feather-icon icon="FacebookIcon" class="icon" />
          <span>Continue with FaceBook</span>
        </div>
        <div class="apple">
          <feather-icon icon="PhoneCallIcon" />
          <span>Sign in with Apple</span>
        </div>
      </div>
      <div class="register">
        <span>or sign in below</span>
      </div>

      <div class="information">
        <input
          v-model="infomation.email"
          type="text"
          :class="{ error: checkEmail }"
          placeholder="Email"
          :style="{ width: '100%' }"
          @keyup="onCheckInfor('email')"
        />
        <p v-if="checkEmail" class="message-error">{{ textEmail }}</p>
        <input
          v-model="infomation.password"
          type="password"
          :class="{ error: checkPassword }"
          placeholder="Password"
          :style="{ width: '100%' }"
          @keyup="onCheckInfor('password')"
        />
        <p v-if="checkPassword" class="message-error">
          {{ textPassword }}
        </p>
      </div>
      <p :style="{ color: 'red' }">{{ messageError }}</p>
      <a href="/forgot-password">Forgot password</a>
      <b-button variant="gradient-primary" class="btn-footer" @click="onSubmit"
        >Sign in <feather-icon icon="ArrowRightIcon" class="icon-footer"
      /></b-button>
    </div>
    <ToastMessage
      v-if="showMessage"
      :type="type"
      @closeMessage="onCloseMessage"
    />
  </div>
</template>

<script>
import loginApi from "../../../api/loginApi";
import ToastMessage from "../layouts/components/ToastMessage.vue";
export default {
  components: {
    ToastMessage,
  },
  data() {
    return {
      checkEmail: false,
      checkPassword: false,
      type: "",
      showMessage: false,
      textEmail: "",
      textPassword: "",
      messageError: "",
      infomation: {
        email: "",
        password: "",
      },
    };
  },
  methods: {
    validate() {
      let check = true;
      if (this.infomation.email == "") {
        this.checkEmail = true;
        check = false;
      }
      if (this.infomation.password == "") {
        this.checkPassword = true;
        check = false;
      }
      return check;
    },
    onCheckInfor(type) {
      if (type == "email") {
        this.checkEmail = false;
      } else {
        this.checkPassword = false;
      }
    },
    onCloseMessage() {
      this.showMessage = false;
    },
    async onSubmit() {
      let payload = {
        email: this.infomation.email,
        password: this.infomation.password,
      };
      if (this.validate() == true) {
        const res = await loginApi(payload);
        if (res) {
          localStorage.setItem("userToken", res.data.access_token);
          localStorage.setItem("login", true);
          window.location.href = "/profile";
        } else {
          this.checkEmail = true;
          this.checkPassword = true;
          this.textEmail = "";
          this.textPassword = "";
          this.messageError =
            "The email or password you entered is incorrect !";
          this.showMessage = true;
          this.type = "error";

          setTimeout(() => {
            this.showMessage = false;
          }, 3000);
        }
      } else {
        this.showMessage = true;
        this.type = "error";
        this.textEmail = "Email required to enter";
        this.textPassword = "Password required to enter";
        setTimeout(() => {
          this.showMessage = false;
        }, 3000);
      }
    },
  },
};
</script>

<style lang="scss" scoped>
.content {
  background-color: #fff;
  box-shadow: 0px 5px 8px 0px rgb(61 61 77 / 20%);
  padding: 35px 50px 30px;
  margin-bottom: 80px;
  text-align: center;
  max-width: 440px;
  margin-left: 50%;
  transform: translateX(-50%);
  border-radius: 8px;
}
.heading {
  font-size: 23px;
  color: #000;
  font-weight: 800;
}

.apple,
.facebook {
  padding: 10px;
  background-color: #4267b2;
  border-radius: 4px;
  color: #fff;
  font-size: 16px;
  cursor: pointer;
}
.apple {
  background-color: #000;
  margin-top: 20px;
}
.icon-footer,
.icon {
  width: 18px;
  height: 18px;
  margin-right: 20px;
}
.register {
  margin: 20px 0;
  color: #9595a5;
  background-color: #fff;
  font-size: 14px;
  position: relative;
}
.register::after,
.register::before {
  content: "";
  position: absolute;
  background-color: #9595a5;
  width: 112px;
  height: 0.5px;
  top: 12px;
}
.register::before {
  left: 0;
}
.register::after {
  right: 0;
}

.information {
  font-size: 20px;
  color: #e5e5e9;
}
input {
  margin-top: 14px;
  border: none;
  padding: 10px 0 20px 10px;
  border-bottom: 1px solid #e5e5e9;
  outline: none;
}
input:focus {
  border-bottom: var(--blue) solid 2px;
}
.btn-footer {
  padding: 10px 90px;
  margin-top: 20px;
  color: #fff;
  font-size: 18px;
  font-weight: 600;
  background-color: var(--blue) !important;
  background-image: none;
}
.message-error {
  color: red;
  text-align: start;
  font-size: 12px;
}
.error {
  border-color: red;
}
.icon-footer {
  margin-bottom: 3px;
}

::placeholder {
  color: #9595a5;
  font-size: 16px;
}
</style>
