<template>
  <div class="col">
    <div>
      <slot></slot>
    </div>
    <div>{{price}} USD x {{qty}} = xxx USD</div>
  </div>
</template>
<script>
export default {
  props: ["price", "qty"]  
};
</script>