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
                            <input type="text" class="form-control" placeholder="Lesson title" v-model="title">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Vimeo video id" v-model="video_id">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" placeholder="Episode number" v-model="episode_number">
                        </div>
                        <div class="form-group">
                            <textarea cols="30" rows="6" class="form-control" style="resize: none;" v-model="description"></textarea>
                        </div>
                        <div class="form-group pull-left">
                            <input type="checkbox" v-model="premium"><span>Premium Lesson!</span>
                        </div>
                        <button type="button" class="btn btn-primary btn-block" @click="CreateLesson">Create lesson</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios'
    export default {
        mounted(){
            this.$parent.$on('create_new_lesson',(seriesId)=>{
                this.seriesId = seriesId
                console.log('Hello from create new lesson')
                $('#createLessonModal').modal()
            })
        },
        data(){
            return {
                title:'',
                description:'',
                video_id:'',
                episode_number:'',
                premium:true,
                seriesId:''
            }
        },
        methods:{
            CreateLesson(){
                axios.post('/admin/'+this.seriesId+'/lessons',{
                    title:this.title,
                    description:this.description,
                    video_id:this.video_id,
                    episode_number:this.episode_number,
                    series_id:this.seriesId
                }).then(res=>{
                    this.$parent.$emit('lesson_created',res.data)
                    $("#createLessonModal").modal('hide')
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    }
</script>