<template>
  <div>
    <div :style="{ marginTop: '120px' }" class="container">
      <div class="content">
        <div class="container-heading">
          <h3 class="heading">Forgot Password</h3>
        </div>
        <div class="register">
          <span>or sign in below</span>
        </div>
        <div class="information">
          <input
            type="text"
            placeholder="Enter email"
            :style="{ width: '100%' }"
            :class="{ error: isError }"
            v-model="infomation.email"
            @focus="onFocusInput('email')"
            @keyup="onChangeEmail"
          />
          <p v-if="isError" class="text-error">{{ messageError }}</p>
        </div>
        <b-button
          variant="gradient-primary"
          class="btn-footer"
          @click="onSubmit"
          >SEND <feather-icon icon="ArrowRightIcon" class="icon-footer"
        /></b-button>
      </div>
    </div>
    <VerifyEmail
      v-if="isSuccess"
      :email="infomation.email"
      @closeModal="onCloseModal"
    />
    <ToastMessage v-if="showMessage" :type="typeMessage" />
  </div>
</template>

<script>
import VerifyEmail from "../layouts/components/VerifyEmail.vue";
import ToastMessage from "../layouts/components/ToastMessage.vue";
import forgotPassword from "../../../api/forgotPassword";
export default {
  components: {
    VerifyEmail,
    ToastMessage,
  },
  data() {
    return {
      isActiveEmail: false,
      isActivePassword: false,
      isError: false,
      isSuccess: false,
      showMessage: false,
      messageError: "",
      typeMessage: "",
      infomation: {
        email: "",
      },
    };
  },
  methods: {
    onFocusInput(type) {
      if (type == "email") {
        this.isActiveEmail = true;
        this.isActivePassword = false;
      } else {
        this.isActivePassword = true;
        this.isActiveEmail = false;
      }
    },
    onChangeEmail() {
      this.isError = false;
    },
    async onSubmit() {
      if (this.infomation.email == "") {
        this.isError = true;
        this.messageError = "Email required to enter";
        this.showMessage = true;
        this.typeMessage = "error";
        setTimeout(() => {
          this.showMessage = false;
        }, 3000);
      } else {
        this.isError = false;
        const res = await forgotPassword(this.infomation);
        if (res) {
          if (res.data) {
            this.isSuccess = true;
          } else {
            this.isError = true;
            this.messageError = res.data.msg;
          }
        }
      }
    },
    onCloseModal() {
      this.isSuccess = false;
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
.icon-footer {
  margin-bottom: 3px;
}
.error {
  border-color: red;
}
.text-error {
  text-align: start;
  color: red;
  font-size: 12px;
}
</style>
