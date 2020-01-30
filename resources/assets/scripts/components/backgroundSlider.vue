<template>
    <div class="background-slider">
        <div v-for="(slide, key) in slides" :class="{'slide-item':true,'showing':key===currentSlide}" :style="{'background-image': `url('${slide}')`}"></div>
    </div>
</template>


<script>
    export default {
        props : ['slides'],
        data() { return {currentSlide : 0} },
        mounted() {
            setInterval(() => this.currentSlide = (this.currentSlide + 1) % this.slides.length, 4000);
        }
    }
</script>

<style lang="scss" scoped>
    %abs-cover {
        top      : 0;
        left     : 0;
        right    : 0;
        bottom   : 0;
        position : absolute;
    }

    .background-slider {
        z-index : 0;
        @extend %abs-cover;

        &:after {
            content          : '';
            z-index          : -1;
            background-color : #000;
            @extend %abs-cover;
        }

        .slide-item {

            opacity             : 0;
            z-index             : 0;
            transition          : opacity 1.5s;
            background-size     : cover;
            background-repeat   : no-repeat;
            background-position : 50% 50%;
            @extend %abs-cover;

            &.showing {
                opacity : .7;
                z-index : 1;
            }
        }
    }
</style>
