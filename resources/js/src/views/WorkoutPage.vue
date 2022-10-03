<template>
  <div>
    <Slider :type="{ id: null, styles: 'workoutPage' }" />
    <div class="container">
      <div class="filter row">
        <div class="col-2 list-filter" @click="onClickFilter('goals')">
          <span :style="{ fontSize: '20px', fontWeight: 'bold' }"
            >{{ title.title1 }}
          </span>
          <feather-icon class="icon-down" icon="ChevronDownIcon" />
          <div v-if="isClickGoals" class="list-item">
            <ul>
              <li
                v-for="item in listMygoals"
                :key="item.id"
                class="item"
                @click="onCheckedItem(item.id, item.name, 'goals')"
              >
                {{ item.name }}
              </li>
            </ul>
          </div>
        </div>
        <div class="col-2 list-filter" @click="onClickFilter('equipment')">
          <span :style="{ fontSize: '20px', fontWeight: 'bold' }"
            >{{ title.title2 }}
          </span>
          <feather-icon class="icon-down" icon="ChevronDownIcon" />
          <div v-if="isClickEquipment" class="list-item">
            <ul>
              <li
                v-for="item in listMyEquipment"
                :key="item.id"
                class="item"
                @click="onCheckedItem(item.id, item.name, 'equipment')"
              >
                {{ item.name }}
              </li>
            </ul>
          </div>
        </div>
        <div class="col-2 list-filter" @click="onClickFilter('level')">
          <span :style="{ fontSize: '20px', fontWeight: 'bold' }"
            >{{ title.title3 }}
          </span>
          <feather-icon class="icon-down" icon="ChevronDownIcon" />
          <div v-if="isClickLevel" class="list-item">
            <ul>
              <li
                v-for="item in listMylevel"
                :key="item.id"
                class="item"
                @click="onCheckedItem(item.id, item.name, 'level')"
              >
                {{ item.name }}
              </li>
            </ul>
          </div>
        </div>
        <span v-if="isShowReset" class="col-1 btn-reset" @click="onReset"
          >Reset</span
        >

        <div class="col-2" :style="{ display: 'flex', alignItems: 'center' }">
          <input
            class="input-search"
            type="text"
            placeholder="Search by name"
          />
        </div>
      </div>
      <h3 :style="{ margin: '58px 0 -52px 18px' }">
        Training Plans {{ lisProduct.length }}
      </h3>
      <div class="row">
        <Product
          v-for="(item, index) in lisProduct"
          :key="index"
          :item="item"
        />
      </div>
      <h3 :style="{ margin: '80px 0 -52px 18px' }">
        Workout Packs & Single Workouts {{ lisProductMini.length }}
      </h3>
      <div class="row">
        <Product
          v-for="(item, index) in lisProductMini"
          :key="index"
          :item="item"
        />
      </div>
    </div>
  </div>
</template>
<script>
import Slider from "../layouts/components/Slider.vue";
import Product from "../layouts/components/Product.vue";

export default {
  components: {
    Slider,
    Product,
  },

  data() {
    return {
      lisProduct: [],
      lisProductMini: [],
      isClickGoals: false,
      isClickEquipment: false,
      isClickLevel: false,
      isShowReset: false,
      title: {
        title1: "My goals",
        title2: "My Equipment",
        title3: "My Level",
      },
      listMygoals: [
        {
          id: 1,
          name: "Lose fat",
        },
        {
          id: 2,
          name: "Get toned",
        },
        {
          id: 3,
          name: "Gain muscle",
        },
        {
          id: 4,
          name: "Incresae Endurance",
        },
        {
          id: 5,
          name: "Incresae flexibility",
        },
      ],
      listMyEquipment: [
        {
          id: 11,
          name: "Full GYM",
        },
        {
          id: 12,
          name: "NONE",
        },
        {
          id: 13,
          name: "Dumbbells",
        },
      ],
      listMylevel: [
        {
          id: 13,
          name: "Beginner",
        },
        {
          id: 14,
          name: "Intermediate",
        },
        {
          id: 15,
          name: "Advenced",
        },
      ],
    };
  },
  created() {
    this.lisProduct = this.$store.state.products.listProduct.filter(
      (product) => product.mini == false
    );
    this.lisProductMini = this.$store.state.products.listProduct.filter(
      (product) => product.mini == true
    );
  },

  methods: {
    onClickFilter(value) {
      if (value == "goals") {
        this.isClickGoals = !this.isClickGoals;
        this.isClickEquipment = false;
        this.isClickLevel = false;
      } else if (value == "equipment") {
        this.isClickEquipment = !this.isClickEquipment;
        this.isClickGoals = false;
        this.isClickLevel = false;
      } else {
        this.isClickLevel = !this.isClickLevel;
        this.isClickEquipment = false;
        this.isClickGoals = false;
      }
    },
    onCheckedItem(id, name, type) {
      if (type == "goals") {
        this.title.title1 = name;
      } else if (type == "level") {
        this.title.title3 = name;
      } else {
        this.title.title2 = name;
      }
      this.lisProduct = this.$store.state.products.listProduct.filter(
        (product) => product.category == id && product.mini == false
      );
      this.lisProductMini = this.$store.state.products.listProduct.filter(
        (product) => product.category == id && product.mini == true
      );
      this.isShowReset = true;
    },
    onReset() {
      this.lisProduct = this.$store.state.products.listProduct.filter(
        (product) => product.mini == false
      );
      this.lisProductMini = this.$store.state.products.listProduct.filter(
        (product) => product.mini == true
      );
      (this.title = {
        title1: "My goals",
        title2: "My Equipment",
        title3: "My Level",
      }),
        (this.isShowReset = false);
    },
  },
};
</script>
<style lang="css" scoped>
.container {
  margin-top: 80px;
}
.filter {
  display: flex;
  justify-content: space-between;
  margin: 20px;
  margin-top: 50px;
}
.list-filter {
  position: relative;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0;
  border-bottom: solid 1px #ccc;
  cursor: pointer;
}
.btn-reset {
  font-size: 18px;
  bottom: -24px;
  color: var(--primary);
  text-decoration: underline;
  cursor: pointer;
}
.input-search {
  border: none;
  border-bottom: solid 1px #ccc;
  padding: 10px;
  outline: none;
  background-color: transparent;
  font-size: 18px;
}
.list-item {
  position: absolute;
  z-index: 1;
  background-color: #fff;
  width: 100%;
  top: 52px;
  box-shadow: 1px 2px 8px #888888;
  border-radius: 4px;
  animation: example linear 0.2s;
}
.item {
  list-style-type: none;
  padding: 8px;
  font-size: 18px;
  font-weight: 600;
}
.item:hover {
  color: var(--primary);
}
ul {
  padding: 0;
}
.icon-down {
  width: 28px;
  height: 28px;
}

@keyframes example {
  from {
    top: -10px;
    opacity: 0.5;
  }
  to {
    top: 0;
    opacity: 1;
  }
}
</style>
