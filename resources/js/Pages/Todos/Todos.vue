<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">
                ToDo List (Inertia Jetsteam)
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                    <div
                        class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                        role="alert"
                        v-if="$page.props.flash.message"
                    >
                        <div class="flex">
                            <div>
                                <p class="text-sm">{{ $page.props.flash.message}}</p>
                            </div>
                        </div>
                    </div>
                    <button
                        class="bg-blue-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded my-3"
                        @click="openModal()">Create New Todo</button>
                    <table class="table-fixed w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 w-20">No.</th>
                                <th class="px-4 py-2">Title</th>
                                <th class="px-4 py-2">Text</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="row in data">
                                <td class="border px-4 py-2">{{ row.id }}</td>
                                <td class="border px-4 py-2">{{ row.title }}</td>
                                <td class="border px-4 py-2">{{ row.text }}</td>
                                <td class="border px-4 py-2">
                                    <button
                                        @click="editTodo(row)"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                    >Edit</button>
                                    <button
                                        @click="deleteTodo(row)"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                    >Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <form-todo ref="formTodo"></form-todo>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout";
import Welcome from "../../Jetstream/Welcome";
import FormTodo from "./FormTodo";
export default {
    name: "todos",
    props: ['data', 'errors', 'page'],
    components: {
        AppLayout,
        Welcome,
        FormTodo
    },
    data: () => ({
        editMode : false,
        isOpen: false,
    }),
    methods: {
        openModal: function () {
            this.$refs.formTodo.open(Object.assign({}), false)

        },
        editTodo: function(data) {
            this.$refs.formTodo.open(Object.assign({}, data), true)
        },
        deleteTodo: function (data) {
            if(!confirm('Are you sure want to remove ?')) return
            data._method = 'DELETE'
            this.$inertia.post('/todos/' + data.id, data)
            this.reset()
        },
        reset: function () {
            this.form = {
                title: null,
                text: null,
            }
        },
    }
}
</script>

<style scoped>

</style>
