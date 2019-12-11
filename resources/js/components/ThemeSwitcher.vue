<template>
	<div class="mr-6 flex items-center">
		<button v-for="(color, theme) in themes"
				class="rounded-full w-4 h-4 bg-default border mr-2 focus:outline-none"
				:class="{ 'border-accent' : selectedTheme === theme }"
				:style="{ backgroundColor: color }"
				@click="selectedTheme = theme"/>
	</div>
</template>

<script>
    export default {

        data() {
            return {
                themes: {
                    'theme-light': '#b8eaff',
                    'theme-dark': '#212121'

                },
                selectedTheme: 'theme-dark'
            };
        },

        created() {
            //check if it needs to pull the selected theme down from storage for different pages
            this.selectedTheme = localStorage.getItem('theme') || 'theme-dark';
        },

        watch: {
            selectedTheme() {
                document.body.className = document.body.className.replace(/theme-\w+/, this.selectedTheme);
                //save the theme to the local storage
                localStorage.setItem('theme', this.selectedTheme);
            }
        }
    }
</script>

<style scoped>

</style>