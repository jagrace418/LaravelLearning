<template>
	<modal name="new-project-modal" classes="p-10 bg-card rounded-lg" height="auto">
		<h1 class="font-normal text-2xl mb-16 text-center">Let's Start Something New</h1>
		<form @submit.prevent="submit">
			<div class="flex">
				<!--			left side-->
				<div class="flex-1 mr-4">
					<div class="mb-4">
						<label for="title" class="text-sm block mb-2">Title</label>
						<input type="text" id="title"
							   v-model="form.title"
							   class="border py-1 px-2 text-xs block rounded w-full">
						<span class="text-xs italic text-error" v-if="errors.title" v-text="errors.title[0]"/>
					</div>
					<div class="mb-4">
						<label for="description"
							   class="text-sm block mb-2">Description</label>
						<textarea id="description" rows="7"
								  v-model="form.description"
								  class="border py-1 px-2 text-xs block w-full rounded"/>
						<span class="text-xs italic text-error" v-if="errors.description"
							  v-text="errors.description[0]"/>
					</div>
				</div>
				<!--right side-->
				<div class="flex-1 mr-4">
					<div class="mb-4">
						<label for="tasks"
							   class="text-sm block mb-2 w-full">Need Some Tasks?</label>
						<input type="text" id="tasks" placeholder="Task"
							   v-for="task in form.tasks"
							   v-model="task.value"
							   class="border mb-2 py-1 px-2 text-xs block rounded">
					</div>

					<button @click="addTask" class="inline-flex items-center button text-xs">
						<span>Add New Task Field</span>
					</button>
				</div>
			</div>

			<footer class="flex justify-end">
				<button class="button mr-2 is-outlined" @click="$modal.hide('new-project-modal')">Cancel</button>
				<button class="button">Create Project</button>
			</footer>
		</form>
	</modal>
</template>

<script>
    export default {
        name: "NewProjectModal",

        data() {
            return {
                form: {
                    title: '',
                    description: '',
                    tasks: [
                        {value: ''},
                    ]
                },
                errors: {}
            };
        },

        methods: {
            addTask() {
                this.form.tasks.push({value: ''});
            },
            submit() {
                axios.post('/projects', this.form)
                    .then(response => {
                        location = response.data.message;
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                    });
            },

            //alternative way with async
            // async submit(){
            //   try {
            // 	  let response = await axios.post('/projects', this.form);
            //       location = response.data.message;
            //   }  catch (error) {
            //       this.errors = error.response.data.errors;
            //   }
            // }
        },
    }
</script>

<style scoped>

</style>