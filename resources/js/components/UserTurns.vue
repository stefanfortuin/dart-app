<template>
	<div
		:key="user.id + 3"
		class="italic mb-3 overflow-y-scroll"
	>
		<div
			v-for="turn in user.turns"
			:key="turn.thrown_score + turn.new_score_to_throw_from"
			class="flex justify-between"
		>
			<div class="text-2xl">
				{{turn.new_score_to_throw_from}}
			</div>
			<div class="flex">
				<div class="mr-3 text-gray-700 text-opacity-70 flex justify-end items-end">
					{{turn.shotScoresInStringFormat}}
				</div>
				<div class="text-2xl text-red-500">

					-{{turn.thrown_score}}
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: ['user'],
}
</script>