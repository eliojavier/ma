<style>
    .activity {
        background: url("../img/squareLinks/ActivityHover.png")  no-repeat center top;
        background-size: contain;
        text-align:center;
    }

    .personal-grow {
        background: url("../img/squareLinks/PGHover.png")  no-repeat center top;
        background-size: contain;
        text-align:center;
    }

    .health {
        background: url("../img/squareLinks/HealthHover.png") no-repeat center top;
        background-size: contain;
        text-align:center;
    }

    .nutrition {
        background: url("../img/squareLinks/NutritionHover.png")  no-repeat center top;
        background-size: contain;
        text-align:center;

    }

    .activity img:hover, .activity img:focus,
    .personal-grow img:hover, .personal-grow img:focus,
    .health img:hover, .health img:focus,
    .nutrition img:hover, .nutrition img:focus {
        opacity:0;
    }

    .health img, .nutrition img,
    .activity img, .personal-grow img{
        width:100%
    }


</style>
<template>
    <div :class="squareLinkClasses" >
        <slot></slot>
    </div>
</template>

<script>
    export default {
        props: ['type'],
        data(){
            return {
                show:true
            };
        },
        computed:{
            squareLinkClasses(){
                var type = this.type;
                return{
                    'activity': type == 'activity',
                    'personal-grow': type == 'personal-grow',
                    'health': type == 'health',
                    'nutrition': type == 'nutrition'
                }
            }
        }
    };
</script>