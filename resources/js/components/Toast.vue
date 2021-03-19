<template>
  <div class="p-4 h-40 w-full rounded-lg text-xl"
  	:class="card_color">
	  <div class="font-semibold mb-2" :class="title_color">Een titel komt hier</div>
	  <div class="" :class="message_color">{{message}}</div>
  </div>
</template>

<script>
export default {
	props: ['message', 'type'],
	computed: {
		card_color(){
			switch (this.type) {
				case 'error':
					return 'bg-red-100';
				case 'success':
					return 'bg-green-100';
				default:
					return 'bg-blue-100';
			}
		},
		title_color(){
			switch (this.type) {
				case 'error':
					return 'text-red-900';
				case 'success':
					return 'text-green-900';
				default:
					return 'text-blue-900';
			}
		},
		message_color(){
			switch (this.type) {
				case 'error':
					return 'text-red-800';
				case 'success':
					return 'text-green-800';
				default:
					return 'text-blue-800';
			}
		},
	}
}
</script>