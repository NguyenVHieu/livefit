<template>
  <div class="modal-verify">
    <div v-if="type != 'register'" class="container-verify">
      <img
        src="data:image/jpeg;base64,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"
      />
      <h3>Verify your email address</h3>
      <p>
        You've entered
        <a :style="{ color: 'red', textDecoration: 'underline' }">{{
          email
        }}</a>
        as the email address for your account
        <br />
        Please verify this email address by clicking button below
      </p>
      <a href="/sign-in">
        <b-button
          class="btn-success"
          variant="gradient-success"
          @click="onClickSuccess"
          >Sign in</b-button
        >
      </a>
    </div>
    <div v-if="type == 'register'" class="container-verify">
      <h3>{{ message }}</h3>
      <a href="/sign-in">
        <b-button
          class="btn-success"
          variant="gradient-success"
          @click="onClickSuccess"
          >Sign in</b-button
        >
      </a>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    email: {
      type: String,
      required: false,
    },
    type: {
      type: String,
      required: false,
    },
    message: {
      type: String,
      required: false,
    },
  },
  created() {
    console.log(132131313515);
  },
  methods: {
    onClickSuccess() {
      this.$emit("closeModal");
    },
  },
};
</script>
<style lang="css" scoped>
.modal-verify {
  position: fixed;
  z-index: 100;
  top: 0;
  right: 0;
  left: 0;
  bottom: 0;
  background-color: rgb(0, 0, 0, 0.5);
}
.container-verify {
  position: absolute;
  background-color: #fff;
  width: 600px;
  text-align: center;
  margin-left: 50%;
  transform: translateX(-50%);
  top: 100px;
  border-radius: 16px;
  padding: 20px 0;
  animation: example 0.5s linear;
}

img {
  width: 200px;
  height: 200px;
}
.btn-success {
  padding: 10px 100px;
  color: #fff;
  font-size: 18px;
  margin-top: 20px;
  font-weight: 600;
}
@keyframes example {
  from {
    top: -10px;
  }
  to {
    top: 100px;
  }
}
</style>