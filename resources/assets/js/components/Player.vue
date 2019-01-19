<template>
    <div :data-vimeo-id="lesson.video_id" data-vimeo-width="900" v-if="lesson" id="handstick"></div>
</template>

<script>
    import Swal from 'sweetalert'
    import videoPlayer from '@vimeo/player'
    export default {
        name: "Player",
        props:['default_lesson','next_lesson_url'],
        data(){
            return{
                lesson:JSON.parse(this.default_lesson)
            }
        },
        methods:{
            displayEndedVideoAlert(){
                if(this.next_lesson_url) {
                    Swal('Yaaa ! yu had finsih this lesson').then(() => {
                        window.location = this.next_lesson_url
                    })
                }else{
                    Swal('Yaaa ! yu had finsih this lesson')
                }
            }
        },
        mounted(){
            const player = new videoPlayer('handstick')
            player.on('ended',()=>{
                this.displayEndedVideoAlert();
            })
        }
    }
</script>