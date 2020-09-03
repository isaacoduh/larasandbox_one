<template>
    <div>
        <div v-if="loading">Data is loading.....</div>
        <div v-else>
            <div class="row mb-4" v-for="row in rows" :key="'row' + row">
                <div class="col d-flex align-items-stretch" v-for="(orderable, column) in bookablesInRow(row)" :key="'row' + row + column">
                    <orderable-list-item
                        :item-title="orderable.title"
                        :item-description="orderable.description"
                        :price="1000"
                    ></orderable-list-item>
                </div>
                <div class="col" v-for="p in placeholdersInRow(row)" :key="'placeholder' + row + p"></div>
            </div>
        </div>
    </div>
</template>

<script>
import OrderableListItem from "./OrderableListItem";
export default {
    components: {
        OrderableListItem
    },
    data() {
        return {
            orderables: null,
            loading: false,
            columns: 3
        };
    },
    computed: {
        rows() {
            return this.orderables === null
                ? 0
                : Math.ceil(this.orderables.length / this.columns);
        }
    },
    methods: {
        bookablesInRow(row){
            return this.orderables.slice((row - 1) * this.columns, row * this.columns);
        },
        placeholdersInRow(row){
            return this.columns - this.bookablesInRow(row).length;
        }
    },
    created() {
        this.loading = true;
        const p = new Promise((resolve, reject) => {
            console.log(resolve);
            console.log(reject);
            setTimeout(() => resolve('Hello'),3000);
        }).then(result => "Hello Again " + result)
        .then(result => console.log(result))
        .catch(result => console.log(`Error ${result}`));
        console.log(p);

        const request = axios.get('/api/orderables').then(response => {
            this.orderables = response.data;
            this.loading = false;
        });
    }
};
</script>
