
<!-- Template for counter component -->
<template id="counter-template">
    <div class="col s4 m2 center-align share-article" @click="updateCount">
        <span class="{{ counter.icon }} rating-icon"></span>
        <p>{{ counter.subject }}</p>
        <button class="rating-counter">{{ count }}</button>
    </div>
</template>

<script>
    export default {
        props: ['counter'],
        data: function () {
            return { count: 0 };
        },
        methods:{
            updateCount: function () {
                console.log(this.counter.subject);
                return this.count += 1;
            }
        }
    };
</script>