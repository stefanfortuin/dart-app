<template>
  <div class="flex text-right opacity-80 text-sm leading-3 xs:leading-normal">
      <transition name="checkout-text" mode="out-in">
        <span v-if="user.checkout != ''" :key="user.checkout">
          {{ user.checkout }}
        </span>
        <span v-else>Kan nog niet uit</span>
      </transition>
    </div>
</template>

<script>
export default {
	props: ['user']
}
</script>