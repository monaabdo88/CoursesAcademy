<template>
    <div class="modal" id="createLessonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Lesson</h5>
                    <button type="button" class="close modalDismiss" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="newLessonForm">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Lesson title" v-model="lesson.title">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Vimeo video id" v-model="lesson.video_id">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" placeholder="Episode number" v-model="lesson.episode_number">
                        </div>
                        <div class="form-group">
                            <textarea cols="30" rows="6" class="form-control" style="resize: none;" v-model="lesson.description"></textarea>
                        </div>
                        <div class="form-group pull-left">
                            <input type="checkbox" v-model="premium"><span>Premium Lesson!</span>
                        </div>
                        <button type="button" class="btn btn-primary btn-block" @click="CreateLesson" v-if="!edit">Create lesson</button>
                        <button type="button" class="btn btn-primary btn-block" @click="updateLesson" v-else="edit">Save lesson</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios'
    class Lesson{
        constructor(lesson){
            this.title = lesson.title || ""
            this.description = lesson.description || ""
            this.video_id = lesson.video_id || ""
            this.episode_number = lesson.episode_number || ""
        }
    }
    export default {
        mounted(){
            this.$parent.$on('create_new_lesson',(seriesId)=>{
                this.seriesId = seriesId
                this.edit=false
                this.lesson = new Lesson({})
                $('#createLessonModal').modal()
            })
            this.$parent.$on('edit_lesson',({lesson,seriesId})=>{
                this.edit=true
                this.seriesId = seriesId
                this.lesson_id = lesson.id
                this.lesson = new Lesson(lesson)
                $('#createLessonModal').modal()
            })
        },
        data(){
            return {
                lesson:{},
                premium:true,
                seriesId:'',
                edit:false,
                lesson_id:null
            }
        },
        methods:{
            CreateLesson(){
                axios.post('/admin/'+this.seriesId+'/lessons',this.lesson).then(res=>{
                    this.$parent.$emit('lesson_created',res.data)
                    $("#createLessonModal").modal('hide')
                }).catch(error=>{
                    console.log(error)
                })
            },
            updateLesson(){
                axios.put('/admin/'+this.seriesId+'/lessons/'+this.lesson_id,this.lesson).then(resp=>{
                    $("#createLessonModal").modal('hide')
                    this.$parent.$emit('lesson_updated',resp.data)
                }).catch(error=>{

                })
            }
        }
    }
</script>