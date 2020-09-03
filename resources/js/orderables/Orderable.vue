<template>
    <div>
        xxx
    </div>
</template>

<script>
export default {
    data(){
        return {
            orderable: null
        };
    },
    created(){
        axios.get(`api/orderables/${this.$route.params.id}`)
        .then(response => (this.bookable = response.data))
    }
};
</script>
