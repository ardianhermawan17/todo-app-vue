<template>
    <div
        v-if="isOpen"
        class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400"
    >
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                role="dialog"
                aria-modal="true"
                aria-labelledby="modal-headline"
            >
                <form>
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div>
                            <div class="mb-4">
                                <label
                                    for="exampleFormControlInput1"
                                    class="block text-gray-700 text-sm font-bold mb-2"
                                >Title :</label>
                                <input
                                    type="text"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="exampleFormControlInput1"
                                    placeholder="Enter Title"
                                    v-model="form.title"
                                >
                                <div
                                    class="text-red-500"
                                    v-if="$page.props.errors.title"
                                >{{ $page.props.errors.body[0]}}</div>
                            </div>
                            <div class="mb-4">
                                <label
                                    for="exampleFormControlInput2"
                                    class="block text-gray-700 text-sm font-bold mb-2"
                                >Text :</label>
                                <input
                                    type="text"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="exampleFormControlInput2"
                                    placeholder="Enter Text"
                                    v-model="form.text"
                                >
                                <div
                                    class="text-red-500"
                                    v-if="$page.props.errors.text"
                                >{{ $page.props.errors.body[0]}}</div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        <span
                                            class="flex w-full rounded-md shadow-md sm:ml-3 sm:w-auto">
                                            <button
                                                type="button"
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-gray-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                                v-show="!isEdit"
                                                @click="save(form)"
                                            >Save</button>
                                        </span>
                        <span
                            class="flex w-full rounded-md shadow-md sm:ml-3 sm:w-auto">
                                            <button
                                                type="button"
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-gray-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                                v-show="isEdit"
                                                @click="update(form)"
                                            >Update</button>
                                        </span>
                        <span
                            class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                                            <button @click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                                Cancel
                                            </button>
                                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "FormTodo",
    data : () => ({
        isOpen : false,
        isEdit: false,
        form : {
            title: null,
            text: null,
        },
    }),
    methods: {
        open: function (data, isEdit) {
            this.isOpen = true
            this.isEdit = isEdit
            this.form = {...data}
        },
        closeModal: function () {
            this.isOpen = false;
            this.reset();
            this.isEdit=false;
        },
        reset: function () {
            this.form = {
                title: null,
                text: null,
            }
        },
        update: function (data) {
            this.$inertia.put('/todos/' + data.id, {
                id : data.id,
                title: data.title,
                text: data.text
            })
            this.reset();
            this.closeModal();
        },
        save: function (data) {
            this.$inertia.post('/todos', data)
            this.reset();
            this.closeModal();
            this.isEdit = false;
        },
    }
}
</script>

<style scoped>

</style>
