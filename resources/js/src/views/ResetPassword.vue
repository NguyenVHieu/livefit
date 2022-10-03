<template>
  <div>
    <div :style="{ marginTop: '120px' }" class="container">
      <div class="content">
        <div class="container-heading">
          <h3 class="heading">Reset Password</h3>
        </div>
        <div class="register">
          <span>or sign in below</span>
        </div>
        <div class="sub-title">
          <p>
            Please create a new password that you don't use on any other site
          </p>
        </div>
        <div class="information">
          <input
            type="password"
            :class="{ 'input-error': checkPassword == false }"
            placeholder="Creat new password"
            :style="{ width: '100%' }"
            v-model="infomation.password"
            @keyup="onChange('password')"
          />
          <p v-if="checkPassword == false" class="text-error">
            {{ texError1 }}
          </p>
          <input
            type="password"
            :class="{ 'input-error': checkNewPassword == false }"
            placeholder="Confirm your password"
            :style="{ width: '100%' }"
            v-model="infomation.newPassword"
            @keyup="onChange('newpassword')"
          />
          <p v-if="checkNewPassword == false" class="text-error">
            {{ texError2 }}
          </p>

          <!-- <p v-if="isError" class="text-error">{{ messageError }}</p> -->
        </div>
        <b-button
          variant="gradient-primary"
          class="btn-footer"
          @click="onSubmit"
          >Save
        </b-button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      texError1: "",
      texError2: "",
      checkPassword: true,
      checkNewPassword: true,
      infomation: {
        password: "",
        newPassword: "",
      },
    };
  },
  methods: {
    onChange(type) {
      if (type == "password") {
        this.checkPassword = true;
      } else {
        this.checkNewPassword = true;
      }
    },
    validate() {
      let check;
      if (this.infomation.password == "") {
        this.checkPassword = false;
        this.texError1 = "Password required to enter !";
        check = false;
      }
      if (this.infomation.newPassword == "") {
        this.checkNewPassword = false;
        this.texError2 = "Confirm password required to enter !";
        check = false;
      }
      return check;
    },
    async onSubmit() {
      if (this.validate() == true) {
        if (this.infomation.password != this.infomation.newPassword) {
          console.log("sai");
        } else {
          console.log("đúng");
        }
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
.sub-title {
  color: green;
  background-color: #d6edd6;
  padding: 16px 0;
  border-radius: 4px;
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
.input-error {
  border-color: red;
}
.text-error {
  color: red;
  text-align: start;
}
p {
  font-size: 12px;
}
::placeholder {
  font-size: 12px;
}
</style>
