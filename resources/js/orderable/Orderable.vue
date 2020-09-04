<template>
    <div class="row">
        <div class="col-md-8 pb-4">
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
            <review-list :orderable-id="this.$route.params.id"></review-list>
        </div>
        <div class="col-md-4 pb-4"><availability :orderable-id="this.$route.params.id" @availability="checkPrice($event)"></availability></div>
    </div>
</template>

<script>
import Availability from './Availability';
import ReviewList from './ReviewList';
export default {
    components: {
        Availability,
        ReviewList
    },
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
            this.orderable = response.data.data;
            this.loading = false;
        });
    }
};
</script>
