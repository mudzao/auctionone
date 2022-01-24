<template>
  <div class="row mb-4">
    <div class="col-md-6">
      <p>
        Name: <span class="text-uppercase">{{ lot.name }}</span>
      </p>
      <p>
        Description: <span>{{ lot.description }}</span>
      </p>
    </div>
    <div class="col-md-6">
      <p>Starting Price: RM {{ lot.starting_price }}</p>
      <p>Step: RM {{ lot.step }}</p>
    </div>
  </div>
</template>

<script>
export default {
  props: ["lot"],
};
</script>