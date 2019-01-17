<template>
    <div :data-vimeo-id="lesson.video_id" data-vimeo-width="900" v-if="lesson" id="handstick"></div>
</template>

<script>
    import videoPlayer from '@vimeo/player'
    export default {
        name: "Player",
        props:['default_lesson'],
        data(){
            return{
                lesson:JSON.parse(this.default_lesson)
            }
        },
        mounted(){
            const player = new videoPlayer('handstick')
            player.on('play',()=>{
                console.log('Player is now play on')
            })
        }
    }
</script>