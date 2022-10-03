<template>
  <div class="toast-message">
    <!-- success -->
    <div v-if="type == 'success'" class="toast-success">
      <feather-icon
        class="icon"
        icon="CheckCircleIcon"
        :style="{ color: 'var(--primary)' }"
      />
      <p class="title">Success</p>
      <feather-icon
        @click="onCloseMessage"
        class="icon"
        icon="XIcon"
        :style="{ cursor: 'pointer' }"
      />
    </div>
    <!-- error -->
    <div v-if="type == 'error'" class="toast-success toast-error">
      <feather-icon
        class="icon"
        icon="AlertCircleIcon"
        :style="{ color: 'red' }"
      />
      <div>
        <p class="title title-error">Error</p>
        <p>Please don't leave it blank !</p>
      </div>
      <feather-icon
        @click="onCloseMessage"
        class="icon"
        icon="XIcon"
        :style="{ cursor: 'pointer' }"
      />
    </div>
  </div>
</template>
<script>
export default {
  props: {
    type: {
      type: String,
      required: false,
    },
  },
  created() {
    console.log("message");
  },
  methods: {
    onCloseMessage() {
      this.$emit("closeMessage");
    },
  },
};
</script>
<style lang="css" scoped>
.toast-message {
  animation: example2 linear 3s;
}
.toast-success {
  position: absolute;
  right: 10px;
  top: 100px;
  display: flex;
  align-items: center;
  background-color: #fff;
  width: 300px;
  padding: 20px 10px;
  margin-left: 20px;
  justify-content: space-between;
  border-radius: 10px;
  border-left: 11px solid var(--primary);
  box-shadow: 4px 5px 10px #ccc;
  animation: example linear 0.2s;
}
.toast-error {
  padding: 10px !important;
  border-left: 11px solid red;
}
.icon {
  width: 20px;
  height: 20px;
}
.title {
  font-size: 20px;
  margin: 0;
  color: var(--primary);
  font-weight: 500;
}
.title-error {
  color: red;
}

@keyframes example {
  from {
    right: -10px;
  }
  to {
    right: 10px;
  }
}
@keyframes example2 {
  from {
    opacity: 1;
  }
  to {
    opacity: 0;
  }
}
</style>