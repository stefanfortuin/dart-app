<template>
  <div class="p-3 mb-2 w-full rounded-lg shadow-lg border-2 border-opacity-80"
  	:class="card_color">
	  <div class="font-semibold text-lg" :class="title_color">{{title}}</div>
	  <div class="" :class="message_color">{{message}}</div>
  </div>
</template>

<script>
export default {
	props: ['title','message', 'type'],
	computed: {
		card_color(){
			switch (this.type) {
				case 'error':
					return 'border-red-400 bg-red-100';
				case 'success':
					return 'border-green-400 bg-green-100';
				default:
					return 'border-indigo-400 bg-indigo-100';
			}
		},
		title_color(){
			switch (this.type) {
				case 'error':
					return 'text-red-800';
				case 'success':
					return 'text-green-900';
				default:
					return 'text-indigo-900';
			}
		},
		message_color(){
			switch (this.type) {
				case 'error':
					return 'text-red-800';
				case 'success':
					return 'text-green-800';
				default:
					return 'text-indigo-800';
			}
		},
	}
}
</script>