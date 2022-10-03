<template>
  <div :style="{ marginTop: '120px' }" class="container">
    <div class="content">
      <div class="container-heading">
        <h3 class="heading">Start your free 14-day trial</h3>
        <p class="sub-heading">If you love it, it's $9.95/mo or $89.95/yr</p>
      </div>
      <div class="conection">
        <div class="facebook">
          <feather-icon icon="FacebookIcon" class="icon" />
          <span>Continue with FaceBook</span>
        </div>
      </div>
      <div class="register">
        <span>or register below</span>
      </div>
      <div class="group-gender">
        <a
          class="btn-gender"
          @click="onClickGender('male')"
          :class="{ active: isMale }"
        >
          <feather-icon icon="UserIcon" class="icon" />
          <span>Male</span>
        </a>
        <a
          class="btn-gender"
          @click="onClickGender('female')"
          :class="{ active: isFemale }"
        >
          <feather-icon icon="UserIcon" class="icon" />
          <span>FeMale</span>
        </a>
      </div>
      <div class="information">
        <input
          class="full-name"
          :class="{ error: checkName }"
          type="text"
          placeholder="Full name ..."
          v-model="infomation.fullname"
          @keyup="onChangeInfo('name')"
        />
        <p class="message-error" v-if="checkName">
          Full name required to enter
        </p>

        <input
          type="text"
          :class="{ error: checkEmail }"
          placeholder="Email ..."
          :style="{ width: '100%' }"
          v-model="infomation.email"
          @keyup="onChangeInfo('email')"
        />
        <p class="message-error" v-if="checkEmail">Email required to enter</p>
        <input
          type="password"
          :class="{ error: checkPassword }"
          placeholder="Create a password ..."
          v-model="infomation.password"
          :style="{ width: '100%' }"
          @keyup="onChangeInfo('password')"
        />
        <p class="message-error" v-if="checkPassword">
          Password required to enter
        </p>
      </div>

      <b-button variant="gradient-primary" class="btn-footer" @click="onSubmit"
        >Chose my program
        <feather-icon icon="ArrowRightIcon" class="icon-footer"
      /></b-button>
    </div>
    <Modal v-if="isShowModal" :type="'register'" :message="message" />
    <ToastMessage v-if="showMessage" :type="typeMessage" />
  </div>
</template>

<script>
import registerApi from "../../../api/registerApi";
import Modal from "../layouts/components/VerifyEmail.vue";
import ToastMessage from "../layouts/components/ToastMessage.vue";
export default {
  components: {
    Modal,
    ToastMessage,
  },
  data() {
    return {
      isMale: false,
      isFemale: false,
      checkName: false,
      checkEmail: false,
      checkPassword: false,
      isShowModal: false,
      showMessage: false,
      typeMessage: "",
      infomation: {
        fullname: "",
        gender: "",
        email: "",
        password: "",
      },
    };
  },
  methods: {
    onClickGender(type) {
      if (type == "male") {
        this.isMale = true;
        this.isFemale = false;
        this.infomation.gender = "male";
      } else {
        this.isFemale = true;
        this.isMale = false;
        this.infomation.gender = "female";
      }
    },
    validate() {
      let check = true;
      if (this.infomation.fullname == "") {
        this.checkName = true;
        check = false;
      }

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
    onChangeInfo(type) {
      if (type == "name") {
        this.checkName = false;
      } else if (type == "email") {
        this.checkEmail = false;
      } else {
        this.checkPassword = false;
      }
    },
    async onSubmit() {
      if (this.validate() == true) {
        const payload = {
          name: this.infomation.fullname,
          gender: this.infomation.gender,
          email: this.infomation.email,
          password: this.infomation.password,
        };
        const res = await registerApi(payload);
        if (res.data) {
          window.location.href = "/sign-in";
        }
      } else {
        this.typeMessage = "error";
        this.showMessage = true;
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
.sub-heading {
  font-size: 15px;
  line-height: 22px;
  margin-top: 4px;
  letter-spacing: -0.5px;
  color: #9595a6;
  font-weight: 300;
}
.facebook {
  padding: 10px;
  background-color: #4267b2;
  border-radius: 4px;
  color: #fff;
  font-size: 16px;
  cursor: pointer;
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
.group-gender {
  box-shadow: 0px 5px 8px 0px rgb(61 61 77 / 20%);
  display: flex;
  justify-content: center;
}
.btn-gender {
  padding: 14px 0;
  border-radius: 4px;
  color: #000;
  font-size: 18px;
  border-radius: 4px;
  width: 50%;
}
.information {
  font-size: 20px;
  color: #e5e5e9;
}
.full-name {
  width: 100%;
}
input {
  margin-top: 14px;
  border: none;
  padding: 10px 0 20px 10px;
  border-bottom: 1px solid #e5e5e9;
  outline: none;
}
input:focus {
  border-bottom: solid 2px var(--blue);
}
.btn-register {
  padding: 10px 70px;
  font-size: 18px;
  color: #fff;
  margin-top: 20px;
}
.btn-footer {
  padding: 10px 54px;
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
.active {
  background-color: var(--blue);
  color: #fff;
}
.message-error {
  font-size: 12px;
  font-weight: 200;
  color: red;
  text-align: start;
}

.error {
  border-color: red;
}
::placeholder {
  font-size: 16px;
}
</style>
