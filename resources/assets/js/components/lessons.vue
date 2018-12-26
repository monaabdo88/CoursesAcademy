<template>
    <div class="container text-center">
        <h1 class="text-center">
            <button class="btn btn-primary" @click="CreateNewLesson">Create New Lesson</button>
        </h1>
        <ul class="list-group">
            <li class="list-group-item" v-for="lesson,key in lessons">
                <div class="col-sm-8"><p class="text-left">{{lesson.title}}</p></div>
                <div class="col-sm-4">
                    <p class="pull-right">
                            <button class="btn btn-primary btn-xs" @click="updateLesson(lesson)">Edit</button>
                            <button class="btn btn-danger btn-xs" @click="deleteLesson(lesson.id,key)">Delete</button>
                    </p>
                </div>
            </li>
        </ul>
        <create-lesson></create-lesson>
    </div>
</template>
<script>
    import axios from 'axios'
    export default {
        props:['default_lessons','series_id'],
        mounted(){
            this.$on('lesson_created',(lesson)=>{
                window.noty({
                    message:"Lesson Created Successfully",
                    type:"success"
                })
                this.lessons.push(lesson)
            })
            this.$on('lesson_updated',(lesson)=>{
                let lessonIndex = this.lessons.findIndex(L=>{
                    return lesson.id = L.id
                })
                window.noty({
                    message:"Lesson Updated Successfully",
                    type:"success"
                })
                this.lessons.splice(lessonIndex,1,lesson)
            })
        },
        components:{
            "create-lesson":require('./children/CreateLesson.vue')
        },
        data (){
            return {
                lessons:JSON.parse(this.default_lessons)
            }
        },
        computed:{

        },
        methods:{
            CreateNewLesson(){
                this.$emit('create_new_lesson',this.series_id)
            },
            deleteLesson(id,key){
                if(confirm('Are You Sure you want to delete this lesson ?')){
                    axios.delete("/admin/"+this.series_id+"/lessons/"+id).then(resp=>{
                        this.lessons.splice(key,1)
                        window.noty({
                            message:"Lesson Removed Successfully",
                            type:"success"
                        })
                    }).catch(error=>{
                        window.handelError(error)
                    })
                }
            },
            updateLesson(lesson){
                let seriesId = this.series_id
                this.$emit('edit_lesson',{lesson,seriesId})
            }

        }
    }
</script>