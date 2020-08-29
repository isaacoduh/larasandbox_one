<template>
    <div>
        <h3 class="text-center">Edit Journal</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateJournal">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" v-model="journal.title">
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea id="" v-model="journal.description" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Author</label>
                        <input type="text" class="form-control" v-model="journal.author">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Journal</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {book: {}}
        },
        created(){
            this.axios.get(`http://localhost:8000/api/journal/edit/${this.$route.params.id}`)
            .then((response) => {
                this.journal = response.data;
            });
        },
        methods: {
            updateJournal(){
                this.axios.post(`http://localhost:8000/api/journal/update/${this.$route.params.id}`, this.journal)
                .then((response) => {
                    this.$router.push({name: 'home'});
                });
            }
        }
    }
</script>
