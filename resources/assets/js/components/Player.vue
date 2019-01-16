<template>
    <div>
        <div data-vimeo-id="19231868" :data-vimeo-width="lesson.video_id" v-if="lesson" id="handstick"></div>
    </div>
</template>
<script>
    import Player from 'vimeo/player'
    export default {
        props:['default_lesson'],
        data(){
            return{
                lesson:JSON.parse(this.default_lesson)
            }
        },
        mounted(){
            const player = new Player('handstick')
            player.on('play',()=>{
                console.log('Player is now play on')
            })
        }
    }
</script>