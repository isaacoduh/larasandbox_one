<template>
    <div>
        <h3 class="text-center">Add Journal</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addJournal">
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
                    <button type="submit" class="btn btn-primary">Add Journal</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                journal: {}
            }
        },
        methods: {
            addJournal(){
                this.axios.post('http://localhost:8000/api/journal/add', this.journal)
                .then(response => (
                    this.$router.push({name: 'home'})
                )).catch(error => console.log(error)).finally(() => this.loading = false)
            }
        }
    }
</script>
