<template>
  <div>
    <div class="row">
      <div class="container">
        <ActivePayment />
      </div>
    </div>
    <div class="row">
      <div class="container">
        <FeatureIncoming />
      </div>
    </div>
  </div>
</template>

<script>
  import ActivePayment from '@/components/panel/active-payment';
  import FeatureIncoming from '@/components/block/feature-incoming';

  export default {
    name: 'Customize',
    components: {
      ActivePayment,
      FeatureIncoming,
    },
  };
</script>
