<template>
    <div :data-vimeo-id="lesson.video_id" data-vimeo-width="900" v-if="lesson" id="handstick"></div>
</template>

<script>

    import axios from 'axios'
    import videoPlayer from '@vimeo/player'
    import swal from 'sweetalert'

    export default {
        name: "Player",
        props: ['default_lesson', 'next_lesson_url'],
        data(){
            return{
                lesson: JSON.parse(this.default_lesson)
            }
        },
        methods:{
            displayVideoEndedAlert(){
                if (this.next_lesson_url) {
                    swal({
                        title: 'Good job!',
                        text: 'You completed this lesson, let\'s see what is next?!',
                        icon: "success",
                        buttons: false,
                        timer: 3000
                    }).then(() => {
                        window.location = this.next_lesson_url
                    })
                }else{
                    swal({
                        title: 'Great job!',
                        text: 'You completed this Series!',
                        icon: "success",
                        buttons: false,
                        timer: 3000
                    })
                }
            },
            completeLesson(){
                axios.post(`/series/complete-lesson/${this.lesson.id}`, {}).then(resp => {
                    this.displayVideoEndedAlert()
                })
            }
        },
        mounted(){
            const player = new videoPlayer('handstick')

            player.on('ended', () => {
                this.completeLesson()
            })
        }
    }
</script>

<style scoped>

</style>