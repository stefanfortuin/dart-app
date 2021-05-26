<template>
  <div class="relative mb-1">
    <div class="overflow-hidden h-2 text-xs flex rounded bg-blue-100" :class="(alignRight) ? 'justify-end' : ''">
        <div :style="{width: `${width}%`}" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center rounded bg-blue-500"></div>
    </div>
</div>
</template>

<script>
export default {
    props: ['max', 'value', 'alignRight'],
    computed: {
        width(){
            return this.value / this.max * 100;
        }
    }
}
</script>