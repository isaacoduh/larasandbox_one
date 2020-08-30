<template>
    <div>
        <h3 class="text-center">All Journals</h3><br/>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Author</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="journal in journals" :key="journal.id">
                    <td>{{journal.id}}</td>
                    <td>{{journal.title}}</td>
                    <td>{{journal.description}}</td>
                    <td>{{journal.author}}</td>
                    <td>{{journal.created_at}}</td>
                    <td>{{journal.updated_at}}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <router-link :to="{name: 'edit', params: {id: journal.id}}" class="btn btn-primary">Edit</router-link>
                            <button class="btn btn-danger" @click="deleteJournal(journal.id)">Delete</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {journals: []}
        },
        created(){
            this.axios
            .get('http://localhost:8000/api/journals').then(response => {
                this.journals = response.data;
            });
        },
        methods: {
            deleteJournal(id){
                this.axios.delete(`http://localhost:8000/api/journal/delete/${id}`).then(response => {
                    let i = this.journals.map(item => item.id).indexOf(id);
                    this.journals.splice(i,1)
                });
            }
        }
    }
</script>
