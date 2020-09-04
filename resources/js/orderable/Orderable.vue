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
        <div class="col-md-4 pb-4">
            <availability
                :orderable-id="this.$route.params.id"
                @availability="checkPrice($event)"
                class="mb-4"
            ></availability>
            <transition name="fade">
                <price-breakdown v-if="price" :price="price" class="mb-4"></price-breakdown>
            </transition>
            <transition>
                <button
                    class="btn btn-outline-secondary btn-block"
                    v-if="price"
                    @click="addToBasket"
                    :disabled="inBasketAlready"
                >Book now</button>
            </transition>

            <button
                class="btn btn-outline-secondary btn-block"
                v-if="inBasketAlready"
                @click="removeFromBasket"
            >Remove From Basket</button>
            <div
                v-if="inBasketAlready"
                class="mt-4 text-muted warning"
            >Seems like you've added this object to basket already. If you want to change dates, remove from the basket first.</div>
        </div>
    </div>
</template>

<script>
import Availability from './Availability';
import ReviewList from './ReviewList';
import PriceBreakdown from './PriceBreakdown';
import {mapState, mapGetters} from "vuex";
export default {
    components: {
        Availability,
        ReviewList,
        PriceBreakdown
    },
    data(){
        return {
            orderable: null,
            loading: false,
            price: null
        };
    },
    created(){
        this.loading = true;
        axios.get(`/api/orderables/${this.$route.params.id}`)
        .then(response => {
            this.orderable = response.data.data;
            this.loading = false;
        });
    },
    computed: {
        ...mapState({
            lastSearch: "lastSearch"
        }),
        inBasketAlready(state){
            if(null === this.orderable){
                return false;
            }

            return this.$store.getters.inBasketAlready(this.orderable.id);
        }
    },
    methods: {
        async checkPrice(hasAvailability){
            if(!hasAvailability){
                this.price = null;
                return;
            }
            try {
                this.price = (await axios.get(`/api/orderables/${this.orderable.id}/price?from=${
                    this.lastSearch.from
                    }&to=${this.lastSearch.to}`))
                    .data.data;
            } catch (err) {
                this.price = null;
            }
        },
        addToBasket(){
            this.$store.dispatch("addToBasket", {
                orderable: this.orderable,
                price: this.price,
                dates: this.lastSearch
            });
        },
        removeFromBasket(){
            this.$store.dispatch("removeFromBasket", this.orderable.id);
        }
    }
};
</script>

<style scoped>
.warning {
  font-size: 0.7rem;
}
</style>
