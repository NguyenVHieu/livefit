<template>
  <div class="workout-guide">
    <div>
      <span>{{ this.$store.state.guide.listText.text1 }}</span>
    </div>
    <div class="list-guide" v-if="isShow">
      <div>
        <span>{{ this.$store.state.guide.listText.text2 }}</span>
      </div>
      <div class="list-set">
        <span>Set 1: {{ this.$store.state.guide.listText.text3.set1 }}</span>
        <span>Set 2: {{ this.$store.state.guide.listText.text3.set2 }}</span>
        <span>Set 3: {{ this.$store.state.guide.listText.text3.set3 }}</span>
        <span>Set 4: {{ this.$store.state.guide.listText.text3.set4 }}</span>
        <span>Set 5: {{ this.$store.state.guide.listText.text3.set5 }}</span>
      </div>
      <div>
        <span>{{ this.$store.state.guide.listText.text4 }}</span>
      </div>
      <div>
        <span>{{ this.$store.state.guide.listText.text5 }}</span>
      </div>
    </div>
    <div class="see-more" @click="onSeeMore">
      <a>SEE MORE</a>
      <feather-icon icon="ChevronDownIcon" />
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      isShow: false,
    };
  },
  methods: {
    onSeeMore() {
      this.isShow = !this.isShow;
    },
  },
};
</script>
<style lang="css" scoped>
.workout-guide {
  font-size: 18px;
  font-weight: 300;
  max-width: 658px;
  margin-left: 50%;
  transform: translateX(-50%);
}
.list-set {
  display: flex;
  flex-direction: column;
}
.see-more {
  text-align: center;
  font-weight: 600;
  color: var(--primary);
}
.see-more:hover a {
  text-decoration: underline;
}
</style>