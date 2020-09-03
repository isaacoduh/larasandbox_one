<template>
    <div>
        <orderable-list-item :item-title="bookable1.title" :item-content="bookable1.content" :price="1000"></orderable-list-item>
        <orderable-list-item :item-title="bookable2.title" :item-content="bookable2.content" :price="1700"></orderable-list-item>
        <orderable-list-item :item-title="bookable3.title" :item-content="bookable3.content" :price="1500"></orderable-list-item>
    </div>
</template>

<script>
    import OrderableListItem from './OrderableListItem';
    export default {
        components: {
            OrderableListItem
        },
        data(){
            return {
                bookable1: null,
                bookable2: null,

            };
        },
        created(){
            console.log('Created');
            console.log(this.bookable1);
            console.log(this.bookable2);

            setTimeout(() => {
                this.bookable1 = {
                    title: "Cheap Villa !!!",
                    content: "A very cheap villa"
                };
                this.bookable2 = {
                    title: "Cheap Villa 2",
                    content: "A very cheap villa 2"
                };
                this.bookable3 = {
                    title: "Expensive villa",
                    content: "A very cheap villa 3"
                };
            },5000);

            setTimeout(() => {
                console.log('First Change');
                this.bookable1.title = 'You will see this!';
            },8000);

            setTimeout(() => {
                console.log('Second Change');
                this.bookable3.title = 'You wont see this!';
            },12000)
        }
    };
</script>
