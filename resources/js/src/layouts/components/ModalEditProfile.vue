<template>
  <div class="container-modal">
    <div class="content-modal">
      <b-card-code :style="{ border: 'none !important' }">
        <feather-icon class="icon-close" icon="XIcon" @click="onClose" />
        <h3 class="heading">Edit profile</h3>
        <b-form>
          <b-row>
            <b-col cols="12">
              <b-form-group
                label="Full Name:"
                label-for="hi-first-name"
                label-cols-md="2"
              >
                <b-input-group class="input-group-merge">
                  <b-input-group-prepend is-text>
                    <feather-icon icon="UserIcon" />
                  </b-input-group-prepend>
                  <b-form-input
                    id="hi-first-name"
                    class="input-value"
                    placeholder="Full Name"
                    v-model="dataUser.name"
                  />
                </b-input-group>
              </b-form-group>
            </b-col>
            <b-col cols="12">
              <b-form-group
                label="Gender:"
                label-for="hi-first-name"
                label-cols-md="2"
              >
                <div class="d-flex">
                  <div :style="{ marginRight: '20px' }">
                    <label class="gender">Male</label>
                    <input
                      class="gender-value"
                      type="radio"
                      value="male"
                      v-model="dataUser.gender"
                    />
                  </div>
                  <div>
                    <label class="gender">Female</label>
                    <input
                      class="gender-value"
                      type="radio"
                      value="female"
                      v-model="dataUser.gender"
                    />
                  </div>
                </div>
              </b-form-group>
            </b-col>

            <b-col cols="12">
              <b-form-group
                label="Email:"
                label-for="hi-email"
                label-cols-md="2"
              >
                <b-input-group class="input-group-merge">
                  <b-input-group-prepend is-text>
                    <feather-icon icon="MailIcon" />
                  </b-input-group-prepend>
                  <b-form-input
                    id="hi-email"
                    class="input-value"
                    type="email"
                    placeholder="Email"
                    v-model="dataUser.email"
                  />
                </b-input-group>
              </b-form-group>
            </b-col>

            <b-col cols="12">
              <b-form-group
                label="Password:"
                label-for="hi-password"
                label-cols-md="2"
              >
                <b-input-group class="input-group-merge">
                  <b-input-group-prepend is-text>
                    <feather-icon icon="LockIcon" />
                  </b-input-group-prepend>
                  <b-form-input
                    id="hi-password"
                    class="input-value"
                    type="password"
                    placeholder="Password"
                    v-model="password"
                  />
                </b-input-group>
              </b-form-group>
            </b-col>

            <!-- submit and reset -->
            <b-col offset-md="4">
              <b-button
                v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                variant="primary"
                class="mr-1 btn-save"
                @click="onSubmit"
              >
                Save
              </b-button>
            </b-col>
          </b-row>
        </b-form>

        <template #code>
          {{ codeHorizontalIcon }}
        </template>
      </b-card-code>
    </div>
    <ToastMessage v-if="showMessage" :type="typeMessage" />
  </div>
</template>

<script>
import BCardCode from "@core/components/b-card-code";
import updateProfile from "../../../../api/updateProfile";
import {
  BFormGroup,
  BFormInput,
  BFormCheckbox,
  BForm,
  BButton,
  BInputGroup,
  BInputGroupPrepend,
  BRow,
  BCol,
} from "bootstrap-vue";
import Ripple from "vue-ripple-directive";
import { codeHorizontalIcon } from "./code";
import ToastMessage from "./ToastMessage.vue";

export default {
  components: {
    BCardCode,
    BRow,
    BCol,
    BFormGroup,
    BFormInput,
    BFormCheckbox,
    BInputGroup,
    BInputGroupPrepend,
    BForm,
    BButton,
    ToastMessage,
  },
  directives: {
    Ripple,
  },
  props: {
    dataUser: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      codeHorizontalIcon,
      password: "",
      showMessage: false,
      typeMessage: null,
    };
  },
  methods: {
    onClose() {
      this.$emit("closeModal");
    },
    async onSubmit() {
      this.dataUser.password = this.password;
      if (
        this.dataUser.name == "" ||
        this.dataUser.email == "" ||
        this.dataUser.gender == "" ||
        this.dataUser.password == ""
      ) {
        this.showMessage = true;
        this.typeMessage = "error";
        setTimeout(() => {
          this.showMessage = false;
        }, 3000);
      } else {
        const res = await updateProfile(this.dataUser);
        if (res) {
          this.showMessage = true;
          this.typeMessage = "success";
          setTimeout(() => {
            this.showMessage = false;
          }, 3000);
        }
      }
    },
  },
};
</script>
 
<style lang="css" scoped>
.container-modal {
  position: fixed;
  z-index: 12;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
}
.content-modal {
  position: absolute;
  background-color: #fff;
  display: flex;
  flex-direction: column;
  align-items: center;
  border-radius: 16px;
  top: 50px;
  left: 50%;
  transform: translateX(-50%);
  padding: 20px;

  animation: example linear 0.5s;
}
.icon-close {
  position: absolute;
  right: 0;
  top: 0;
  cursor: pointer;
  width: 20px;
  height: 20px;
  opacity: 0.5;
}
.heading {
  text-align: center;
  text-transform: uppercase;
  color: var(--blue);
  margin-bottom: 20px;
}
.icon-close:hover {
  opacity: 1;
}
.input-value {
  padding: 20px 10px !important;
}
.gender {
  font-size: 16px;
  margin-right: 10px;
}
.gender-value {
  width: 20px;
  height: 20px;
  position: relative;
  top: 4px;
}
.btn-save {
  margin-left: 44px;
  padding: 10px 54px;
  font-size: 16px;
  font-weight: 600;
  margin-top: 20px;
}

@keyframes example {
  from {
    top: -10px;
  }
  to {
    top: 50px;
  }
}
</style>
