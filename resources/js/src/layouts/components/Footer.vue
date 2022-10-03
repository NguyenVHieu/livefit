<template>
  <div class="footer">
    <b-button class="btn-footer">Start this plan free</b-button>
  </div>
</template>
<style lang="css" scoped>
.footer {
  position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
  box-shadow: 0px -2px 5px 0px rgb(61 61 77 / 10%);
  background: #fff;
  background: rgba(255, 255, 255, 0.95);
  text-align: center;
  padding: 10px 0;
  z-index: 12;
}
.btn-footer {
  text-transform: uppercase;
  padding: 10px 20px;
  background-color: var(--primary) !important;
  color: #fff;
  font-weight: bold;
  font-size: 18px;
  border: none;
}
</style>