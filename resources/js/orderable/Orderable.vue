<template>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div v-if="!loading">
                        <h2>{{orderable.title}}</h2>
                        <hr/>
                        <article>{{orderable.description}}</article>
                    </div>
                    <div v-else>Loading....</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">availabilty & prices</div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            orderable: null,
            loading: false,
        };
    },
    created(){
        this.loading = true;
        axios.get(`/api/orderables/${this.$route.params.id}`)
        .then(response => {
            this.orderable = response.data;
            this.loading = false;
        });
    }
};
</script>
